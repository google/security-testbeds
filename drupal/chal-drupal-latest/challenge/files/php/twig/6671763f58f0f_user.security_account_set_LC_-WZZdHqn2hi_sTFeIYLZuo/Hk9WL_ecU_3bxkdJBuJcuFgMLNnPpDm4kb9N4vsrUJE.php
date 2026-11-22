<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @help_topics/user.security_account_settings.html.twig */
class __TwigTemplate_de526ae53fa0b1e20c8663edd1b365ca extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        ob_start(function () { return ''; });
        echo t("Account settings", array());
        $context["account_settings_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["account_settings_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["account_settings_link_text"] ?? null), 8, $this->source), "entity.user.admin_form"));
        // line 9
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 10
        echo t("Configure settings related to how user accounts are created and deleted.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("What are the settings related to user account creation and deletion?", array());
        echo "</h2>
<ul>
  <li>";
        // line 13
        echo t("You can make it possible for new users to register themselves for accounts, with or without email verification or administrative approval. Or, you can make it so only administrators with <em>Administer users</em> permission can register new users.", array());
        echo "</li>
  <li>";
        // line 14
        echo t("You can configure what happens to content that a user created, if their account is <em>canceled</em> (deleted).", array());
        echo "</li>
  <li>";
        // line 15
        echo t("You can edit the email messages that are sent to users when their accounts are pending, approved, created, blocked, or canceled, or when they request a password reset.", array());
        echo "</li>
</ul>
<h2>";
        // line 17
        echo t("What are variables in email message text?", array());
        echo "</h2>
<p>";
        // line 18
        echo t("<em>Variables</em> are short text strings, enclosed in square brackets [], that you can insert into configured email message text. When an individual message is generated, data from your site is substituted for the variables. Some commonly-used variables are:", array());
        echo "</p>
<ul>
  <li>";
        // line 20
        echo t("[site:name]: The name of your website.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("[site:url]: The URL of your website.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("[site:login-url]: The URL where users can log in to your site.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("[user:display-name]: The user's displayed name.", array());
        echo "</li>
  <li>";
        // line 24
        echo t("[user:account-name]: The user's account name.", array());
        echo "</li>
  <li>";
        // line 25
        echo t("[user:mail]: The user's email alias.", array());
        echo "</li>
  <li>";
        // line 26
        echo t("[user:one-time-login-url]: An expiring URL that a user can use to log in once, if they need to reset their password.", array());
        echo "</li>
</ul>
<h2>";
        // line 28
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 30
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>People</em> &gt; <em>@account_settings_link</em>.", array("@account_settings_link" => ($context["account_settings_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 31
        echo t("Select the method you want to use for creating user accounts, and check or uncheck the box that requires email verification, to match the settings you want for your site.", array());
        echo "</li>
  <li>";
        // line 32
        echo t("Select the desired option for what happens to content that a user created if their account is canceled.", array());
        echo "</li>
  <li>";
        // line 33
        echo t("Optionally, edit the text of email messages related to user accounts.", array());
        echo "</li>
  <li>";
        // line 34
        echo t("Verify that the other settings are correct.", array());
        echo "</li>
  <li>";
        // line 35
        echo t("Click <em>Save configuration</em>. You should see a message indicating that the settings were saved.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/user.security_account_settings.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  135 => 35,  131 => 34,  127 => 33,  123 => 32,  119 => 31,  115 => 30,  110 => 28,  105 => 26,  101 => 25,  97 => 24,  93 => 23,  89 => 22,  85 => 21,  81 => 20,  76 => 18,  72 => 17,  67 => 15,  63 => 14,  59 => 13,  54 => 11,  50 => 10,  45 => 9,  43 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/user.security_account_settings.html.twig", "/opt/drupal/web/core/modules/user/help_topics/user.security_account_settings.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 30);
        static $functions = array("render_var" => 8, "help_route_link" => 8);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
