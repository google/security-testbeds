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

/* @help_topics/system.config_error.html.twig */
class __TwigTemplate_d81dd5f13b5ac5e477804c838cdd2c79 extends Template
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
        echo t("Logging and errors", array());
        $context["log_settings_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["log_settings_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["log_settings_link_text"] ?? null), 8, $this->source), "system.logging_settings"));
        // line 9
        ob_start(function () { return ''; });
        echo t("Basic site settings", array());
        $context["information_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["information_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["information_link_text"] ?? null), 10, $this->source), "system.site_information_settings"));
        // line 11
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 12
        echo t("Set up your site to respond appropriately to site errors, including 403 and 404 page responses.", array());
        echo "</p>
<h2>";
        // line 13
        echo t("What are 403 and 404 responses?", array());
        echo "</h2>
<p>";
        // line 14
        echo t("When a user visits a web page, the web server sends a response code in addition to the page content. A normal, non-error response has code 200. If the page does not exist on the site, the response code is 404. If the page exists, but the user is not authorized to visit the page, the response code is 403. The core software provides default responses for both 403 and 404 codes, but if you prefer, you can create your own pages for each.", array());
        echo "</p>
<h2>";
        // line 15
        echo t("What other errors can occur?", array());
        echo "</h2>
<p>";
        // line 16
        echo t("Under some situations, your site can generate error messages. These can be due to user errors (such as entering invalid values in a form, or incorrect configuration), PHP runtime errors, or software bugs. Some errors may result in a <em>white screen of death</em> (a totally blank web page response); less drastic errors will generate error messages. You can configure what happens when an error message is generated.", array());
        echo "</p>
<h2>";
        // line 17
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 19
        echo t("If desired, create pages to use for 403 and 404 responses. Note the URLs for these pages.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>System</em> &gt; <em>@information_link</em>.", array("@information_link" => ($context["information_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 21
        echo t("In the <em>Error pages</em> section, enter the URL for your 403/404 pages, starting after the site home page URL. For example, if your site URL is <em>https://example.com</em> and your 404 page is <em>https://example.com/not-found</em>, you would enter <em>/not-found</em>.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("Click <em>Save configuration</em>. You should see a message indicating that the settings were saved.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Development</em> &gt; <em>@log_settings_link</em>.", array("@log_settings_link" => ($context["log_settings_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 24
        echo t("For a production site, select <em>None</em> under <em>Error messages to display</em>. For a site that is in development, select one of the other options, so that you are more aware of the errors the site is generating.", array());
        echo "</li>
  <li>";
        // line 25
        echo t("Click <em>Save configuration</em>. You should see a message indicating that the settings were saved.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/system.config_error.html.twig";
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
        return array (  105 => 25,  101 => 24,  97 => 23,  93 => 22,  89 => 21,  85 => 20,  81 => 19,  76 => 17,  72 => 16,  68 => 15,  64 => 14,  60 => 13,  56 => 12,  51 => 11,  49 => 10,  45 => 9,  43 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/system.config_error.html.twig", "/opt/drupal/web/core/modules/system/help_topics/system.config_error.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 20);
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
