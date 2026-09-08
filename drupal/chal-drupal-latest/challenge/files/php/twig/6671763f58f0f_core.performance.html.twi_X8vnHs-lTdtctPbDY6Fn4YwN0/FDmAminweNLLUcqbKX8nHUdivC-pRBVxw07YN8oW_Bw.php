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

/* @help_topics/core.performance.html.twig */
class __TwigTemplate_ea9b083a397fc44870f02bb529e98d07 extends Template
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
        // line 5
        echo "<h2>";
        echo t("What is site performance?", array());
        echo "</h2>
<p>";
        // line 6
        echo t("Site performance, in this context, refers to speed factors such as the page load time and the response time after a user action on a page.", array());
        echo "</p>
<h2>";
        // line 7
        echo t("What is caching?", array());
        echo "</h2>
<p>";
        // line 8
        echo t("Caching is saving already-rendered HTML output and other calculated data for later use the first time it is needed. This saves time, because the next time the same data is needed it can be quickly retrieved instead of recalculated. Automatic caching systems also include mechanisms to delete cached calculations or mark them as no longer valid when the underlying data changes. To facilitate that, cached data has a <em>lifetime</em>, which is the maximum time before the data will be deleted from the cache (forcing recalculation).", array());
        echo "</p>
<h2>";
        // line 9
        echo t("What is file aggregation?", array());
        echo "</h2>
<p>";
        // line 10
        echo t("Aggregation is when CSS and JavaScript files are merged together and compressed into a format that is much smaller than the original. This allows for faster transmission and faster rendering on the other end.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("What can I do to improve my site's performance?", array());
        echo "</h2>
<p>";
        // line 12
        echo t("The following core software modules and mechanisms can improve your site's performance:", array());
        echo "</p>
<dl>
  <dt>";
        // line 14
        echo t("Internal Page Cache module", array());
        echo "</dt>
  <dd>";
        // line 15
        echo t("Caches pages requested by users who are not logged in (anonymous users). Do not use if your site needs to send different output to different anonymous users.", array());
        echo "</dd>
  <dt>";
        // line 16
        echo t("Internal Dynamic Page Cache module", array());
        echo "</dt>
  <dd>";
        // line 17
        echo t("Caches data for both authenticated and anonymous users, with non-cacheable data in the page converted to placeholders and calculated when the page is requested.", array());
        echo "</dd>
  <dt>";
        // line 18
        echo t("Big Pipe module", array());
        echo "</dt>
  <dd>";
        // line 19
        echo t("Changes the way pages are sent to users, so that cacheable parts are sent out first with placeholders, and the uncacheable or personalized parts of the page are streamed afterwards. This allows the browser to render the bulk of the page quickly and fill in the details later.", array());
        echo "</dd>
  <dt>";
        // line 20
        echo t("Performance page settings", array());
        echo "</dt>
  <dd>";
        // line 21
        echo t("In the <em>Manage</em> administrative menu, if you navigate to <em>Configuration</em> &gt; <em>Development</em> &gt; <em>Performance</em>, you will find a setting for the maximum cache lifetime, as well as the ability to turn on CSS and JavaScript file aggregation.", array());
        echo "</dd>
</dl>

<h2>";
        // line 24
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/documentation/modules/internal_page_cache\">";
        // line 26
        echo t("Online documentation for the Internal Page Cache module", array());
        echo "</a></li>
  <li><a href=\"https://www.drupal.org/documentation/modules/dynamic_page_cache\">";
        // line 27
        echo t("Online documentation for the Internal Dynamic Page Cache module", array());
        echo "</a></li>
  <li><a href=\"https://www.drupal.org/documentation/modules/big_pipe\">";
        // line 28
        echo t("Online documentation for the BigPipe module", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.performance.html.twig";
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
        return array (  120 => 28,  116 => 27,  112 => 26,  107 => 24,  101 => 21,  97 => 20,  93 => 19,  89 => 18,  85 => 17,  81 => 16,  77 => 15,  73 => 14,  68 => 12,  64 => 11,  60 => 10,  56 => 9,  52 => 8,  48 => 7,  44 => 6,  39 => 5,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.performance.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.performance.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 5);
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
