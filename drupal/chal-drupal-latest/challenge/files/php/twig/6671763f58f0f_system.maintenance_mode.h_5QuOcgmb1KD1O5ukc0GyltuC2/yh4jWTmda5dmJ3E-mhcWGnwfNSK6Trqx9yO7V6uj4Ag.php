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

/* @help_topics/system.maintenance_mode.html.twig */
class __TwigTemplate_b17088dc77edf61ff084d99d02179e25 extends Template
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
        $context["cache_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("system.cache"));
        // line 8
        ob_start(function () { return ''; });
        echo t("Maintenance mode", array());
        $context["maintenance_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        $context["maintenance_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["maintenance_link_text"] ?? null), 9, $this->source), "system.site_maintenance_mode"));
        // line 10
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 11
        echo t("Put your site in maintenance mode to perform maintenance operations, and then return to normal mode when finished.", array());
        echo "</p>
<h2>";
        // line 12
        echo t("What is maintenance mode?", array());
        echo "</h2>
<p>";
        // line 13
        echo t("When your site is in maintenance mode, most site visitors will see a simple maintenance mode message page, rather than being able to use the full functionality of the site. Users with <em>Use the site in maintenance mode</em> permission who are already logged in will be able to use the full site, and the log in page at <em>/user</em> will also be accessible to anyone.", array());
        echo "</p>
<h2>";
        // line 14
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 16
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Development</em> &gt; <em>@maintenance_link</em>.", array("@maintenance_link" => ($context["maintenance_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 17
        echo t("Check <em>Put site into maintenance mode</em>, optionally change the <em>Message to display when in maintenance mode</em>, and click <em>Save configuration</em>. Your site will be in maintenance mode.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("Perform your maintenance operations.", array());
        echo "</li>
  <li>";
        // line 19
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Development</em> &gt; <em>@maintenance_link</em>.", array("@maintenance_link" => ($context["maintenance_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 20
        echo t("Uncheck <em>Put site into maintenance mode</em> and click <em>Save configuration</em>. Your site will be back in normal operation mode.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Clear the site cache. See @cache_topic for instructions.", array("@cache_topic" => ($context["cache_topic"] ?? null), ));
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/system.maintenance_mode.html.twig";
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
        return array (  89 => 21,  85 => 20,  81 => 19,  77 => 18,  73 => 17,  69 => 16,  64 => 14,  60 => 13,  56 => 12,  52 => 11,  47 => 10,  45 => 9,  41 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/system.maintenance_mode.html.twig", "/opt/drupal/web/core/modules/system/help_topics/system.maintenance_mode.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 8);
        static $filters = array("escape" => 16);
        static $functions = array("render_var" => 7, "help_topic_link" => 7, "help_route_link" => 9);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link', 'help_route_link']
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
