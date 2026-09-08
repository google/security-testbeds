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

/* @help_topics/core.cron.html.twig */
class __TwigTemplate_3e062292aa929566504e953c4c54f9c5 extends Template
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
        // line 6
        ob_start(function () { return ''; });
        echo t("Cron", array());
        $context["cron_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 7
        $context["cron_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["cron_link_text"] ?? null), 7, $this->source), "system.cron_settings"));
        // line 8
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 9
        echo t("Configure your system so that cron will run automatically.", array());
        echo "</p>
<h2>";
        // line 10
        echo t("What are cron tasks?", array());
        echo "</h2>
<p>";
        // line 11
        echo t("To ensure that your site and its modules continue to function well, a group of administrative operations should be run periodically. These operations are called <em>cron</em> tasks, and running the tasks is known as <em>running cron</em>. Depending on how often content is updated on your site, you might need to run cron on a schedule ranging from hourly to weekly to keep your site running well.", array());
        echo "</p>
<h2>";
        // line 12
        echo t("What options are available for running cron?", array());
        echo "</h2>
<ul>
  <li>";
        // line 14
        echo t("If the core Automated Cron module is installed, your site will run cron periodically, on a schedule you can configure.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("You can set up a task on your web server to visit the <em> cron URL</em>, which is unique to your site, on a schedule.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("You can also run cron manually, but this is not the recommended way to make sure it is run periodically.", array());
        echo "</li>
</ul>
<h2>";
        // line 18
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 20
        echo t("In the <em>Manage</em> administration menu, navigate to <em>Configuration</em> &gt; <em>System</em> &gt; <em>@cron_link</em>. Note the <em>Last run</em> time on the page.", array("@cron_link" => ($context["cron_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 21
        echo t("If you want to run cron right now, click <em>Run cron</em> and wait for cron to finish.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("If you have a way to configure tasks on your web server, copy the link where it says <em>To run cron from outside the site, go to</em>. Set up a task to visit that URL on your desired cron schedule, such as once an hour or once a week. (On Linux-like servers, you can use the <em>wget</em> command to visit a URL.) If you configure an outside task, you should uninstall the Automated Cron module.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("If you are not configuring an outside task, and you have the core Automated Cron module installed, select a schedule for automated cron runs in <em>Cron settings</em> &gt; <em>Run cron every</em>. Click <em>Save configuration</em>.", array());
        echo "</li>
</ol>
<h2>";
        // line 25
        echo t("Additional resources", array());
        echo "</h2>
<ul>
    <li>";
        // line 27
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/security-cron-concept.html\">Concept: Cron (Drupal User Guide)</a>", array());
        echo "</li>
    <li>";
        // line 28
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/security-cron.html\">Configuring Cron Maintenance Tasks (Drupal User Guide)</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.cron.html.twig";
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
        return array (  111 => 28,  107 => 27,  102 => 25,  97 => 23,  93 => 22,  89 => 21,  85 => 20,  80 => 18,  75 => 16,  71 => 15,  67 => 14,  62 => 12,  58 => 11,  54 => 10,  50 => 9,  45 => 8,  43 => 7,  39 => 6,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.cron.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.cron.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 6, "trans" => 6);
        static $filters = array("escape" => 20);
        static $functions = array("render_var" => 7, "help_route_link" => 7);

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
