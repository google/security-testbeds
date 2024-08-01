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

/* @help_topics/system.reports.html.twig */
class __TwigTemplate_aa73303d3697c16a237b77ba84ab44c8 extends Template
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
        // line 8
        ob_start(function () { return ''; });
        echo t("Status report", array());
        $context["status_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        $context["status_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["status_link_text"] ?? null), 9, $this->source), "system.status"));
        // line 10
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 11
        echo t("Run reports to learn about the status and health of your site.", array());
        echo "</p>
<h2>";
        // line 12
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 14
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Reports</em> &gt; <em>@status_link</em> to see a report that summarizes the health and status of your site. If there are any warnings or errors, you will need to fix them. Take note of any upcoming highly critical security releases that may impact your site.", array("@status_link" => ($context["status_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 15
        echo t("If you have the core Database Logging module installed, in the <em>Manage</em> administrative menu, navigate to <em>Reports</em> &gt; <em>Recent log messages</em> to see a report of the error and informational messages your site has generated. You can filter the report by <em>Severity</em> to see only the most critical messages, if desired.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("If you have the core Update Manager module installed, in the <em>Manage</em> administrative menu, navigate to <em>Reports</em> &gt; <em>Available updates</em> to see a report of the updates that are available for your site software. If <em>Last checked</em> is far in the past, click <em>Check manually</em> to update the report. Scan the report; if the core software or any modules or themes have security updates available, you should update them as soon as possible.", array());
        echo "</li>
</ol>
<h2>";
        // line 18
        echo t("Additional resources", array());
        echo "</h2>
<ul>
    <li>";
        // line 20
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/security-chapter.html\">Security and Maintenance (Drupal User Guide)</a>, which includes information on how to update your site's core software, modules, and themes.", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/system.reports.html.twig";
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
        return array (  77 => 20,  72 => 18,  67 => 16,  63 => 15,  59 => 14,  54 => 12,  50 => 11,  45 => 10,  43 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/system.reports.html.twig", "/opt/drupal/web/core/modules/system/help_topics/system.reports.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 8);
        static $filters = array("escape" => 14);
        static $functions = array("render_var" => 9, "help_route_link" => 9);

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
