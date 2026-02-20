package com.livy.auth;

import javax.servlet.*;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.security.Principal;

/**
 * Custom authentication filter for Apache Livy.
 *
 * Validates requests using a static bearer token passed via the "Authorization" header.
 * The expected token is configured through the Livy config property:
 *   livy.server.auth.token.param.token = &lt;secret-value&gt;
 *
 * Requests without a valid "Authorization: Bearer &lt;token&gt;" header receive a 401 response.
 */
public class TokenAuthFilter implements Filter {

    private String expectedToken;

    @Override
    public void init(FilterConfig filterConfig) throws ServletException {
        expectedToken = filterConfig.getInitParameter("token");
        if (expectedToken == null || expectedToken.isEmpty()) {
            throw new ServletException(
                "TokenAuthFilter requires 'token' init parameter. "
                + "Set livy.server.auth.token.param.token in livy.conf");
        }
    }

    @Override
    public void doFilter(ServletRequest request, ServletResponse response, FilterChain chain)
            throws IOException, ServletException {

        HttpServletRequest httpReq = (HttpServletRequest) request;
        HttpServletResponse httpResp = (HttpServletResponse) response;

        String authHeader = httpReq.getHeader("Authorization");

        if (authHeader != null && authHeader.startsWith("Bearer ")) {
            String token = authHeader.substring("Bearer ".length()).trim();
            if (token.equals(expectedToken)) {
                // Wrap request so Livy sees an authenticated principal
                HttpServletRequest wrappedRequest = new AuthenticatedRequestWrapper(httpReq, "livy-user");
                chain.doFilter(wrappedRequest, response);
                return;
            }
        }

        httpResp.setStatus(HttpServletResponse.SC_UNAUTHORIZED);
        httpResp.setContentType("application/json");
        httpResp.getWriter().write("{\"error\": \"Unauthorized. Provide a valid Authorization: Bearer <token> header.\"}");
    }

    @Override
    public void destroy() {
        // no-op
    }

    /**
     * Wrapper that exposes the authenticated user as a Principal so Livy's
     * access-control layer can identify the caller.
     */
    private static class AuthenticatedRequestWrapper extends javax.servlet.http.HttpServletRequestWrapper {
        private final String username;

        AuthenticatedRequestWrapper(HttpServletRequest request, String username) {
            super(request);
            this.username = username;
        }

        @Override
        public Principal getUserPrincipal() {
            return () -> username;
        }

        @Override
        public String getRemoteUser() {
            return username;
        }
    }
}
