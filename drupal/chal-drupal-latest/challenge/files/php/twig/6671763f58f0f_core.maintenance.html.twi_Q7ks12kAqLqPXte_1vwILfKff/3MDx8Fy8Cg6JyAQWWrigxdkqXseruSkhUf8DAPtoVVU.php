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

/* @help_topics/core.maintenance.html.twig */
class __TwigTemplate_1919e5a3fc0c5caad1af68d13436aced extends Template
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
        // line 12
        echo "<h2>";
        echo t("Maintaining and troubleshooting overview", array());
        echo "</h2>
<p>";
        // line 13
        echo t("Here are some tasks and hints related to maintaining your site, and troubleshooting problems that may come up on your site. See the related topics below for more information.", array());
        echo "</p>
<ul>
  <li>";
        // line 15
        echo t("When performing maintenance, such as installing, uninstalling, or updating a module, put your site in maintenance mode.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("Configure your site so that cron runs periodically.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("If your site is not behaving as expected, clear the cache before trying to diagnose the problem.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("There are several site reports that can help you diagnose problems with your site. There are also two core modules that can be used for error logging: Database Logging and Syslog.", array());
        echo "</li>
</ul>
<h2>";
        // line 20
        echo t("Additional resources", array());
        echo "</h2>
<ul>
    <li>";
        // line 22
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/prevent-chapter.html\">Preventing and Fixing Problems (Drupal User Guide)</a>", array());
        echo "</li>
    <li>";
        // line 23
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/security-chapter.html\">Security and Maintenance (Drupal User Guide)</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.maintenance.html.twig";
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
        return array (  75 => 23,  71 => 22,  66 => 20,  61 => 18,  57 => 17,  53 => 16,  49 => 15,  44 => 13,  39 => 12,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.maintenance.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.maintenance.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 12);
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['trans'],
                [],
                []
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
