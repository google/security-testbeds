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

/* @help_topics/views.overview.html.twig */
class __TwigTemplate_4ae4e335c25270ccb609eaa4dc7a4886 extends Template
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
        // line 9
        echo "<h2>";
        echo t("What is a view?", array());
        echo "</h2>
<p>";
        // line 10
        echo t("A <em>view</em> is a listing of items on your site; for example, a block showing the most recent comments, a page listing news items, or a list of registered users. The listings can be formatted in a table, grid, list, calendar, RSS feed, and other formats (some output formats may require you to install additional contributed modules).", array());
        echo "</p>
<h2>";
        // line 11
        echo t("What are the components of a view?", array());
        echo "</h2>
<p>";
        // line 12
        echo t("When you first create a view, you will specify what type of <em>base data</em> is being displayed in the view, which cannot be changed. After choosing a base data type, you can edit the following components, which allow you to specify which data to output, in what order, and in what format:", array());
        echo "</p>
<ul>
  <li>";
        // line 14
        echo t("<em>Displays</em>: whether the output goes to a page, block, feed, etc.; a single view can have multiple displays, each with different settings.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("<em>Format</em>: the output style for each display, such as content item, grid, table, or HTML list.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("<em>Fields</em>: if the Format allows, the particular fields to display.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("<em>Filter criteria</em>: criteria to limit the data to output, such as whether the content is published, the type of content, etc. Filters can be <em>exposed</em> to let users choose how to filter the data.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("<em>Sort criteria</em>: how to order the data. Sorting can also be exposed to users.", array());
        echo "</li>
  <li>";
        // line 19
        echo t("<em>Page settings</em>, <em>Block settings</em>, etc.: settings specific to the display type, such as the URL for a page display. Most display types support an <em>Access</em> setting, where you can choose a Permission or Role that a user must have in order to see the view.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("<em>Header</em> and <em>Footer</em>: content to display at the top or bottom of the view display.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("<em>No results behavior</em>: what to do if the filter criteria result in having no data to display.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("<em>Pager</em>: how many items to display, and how to paginate if there are additional items to display.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("<em>Advanced</em> &gt; <em>Contextual filters</em>: like regular filters, except the criteria come from the <em>context</em>, such as the current date, page the view is displayed on, etc.", array());
        echo "</li>
  <li>";
        // line 24
        echo t("<em>Advanced</em> &gt; <em>Relationships</em>: additional data to pull in and display, related in some way to the base data of the view (such as data about the user who created the content item).", array());
        echo "</li>
  <li>";
        // line 25
        echo t("<em>Advanced</em> &gt; <em>Exposed form</em>: if you have exposed filters or sorts, how to display the form to the user.", array());
        echo "</li>
</ul>
<h2>";
        // line 27
        echo t("What are bulk operations?", array());
        echo "</h2>
<p>";
        // line 28
        echo t("Views using a table display format can include a bulk operations form, which allows users with sufficient permission to select one or more items from the view and apply an administrative action to them. The bulk actions available are specific to the base data type of the view; for example, a view of content items could support bulk publishing and unpublishing actions. If you have the core Actions UI module installed, see the related topic \"Configuring actions\" for more about actions.", array());
        echo "</p>
<h2>";
        // line 29
        echo t("Managing views overview", array());
        echo "</h2>
<p>";
        // line 30
        echo t("The core Views module handles the display of views, and the core Views UI module allows you to create, edit, and delete views in the administrative interface. See the related topics listed below for specific tasks (if the Views UI module is installed).", array());
        echo "</p>
<h2>";
        // line 31
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li>";
        // line 33
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/views-chapter.html\">Creating Listings with Views (Drupal User Guide)</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/views.overview.html.twig";
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
        return array (  127 => 33,  122 => 31,  118 => 30,  114 => 29,  110 => 28,  106 => 27,  101 => 25,  97 => 24,  93 => 23,  89 => 22,  85 => 21,  81 => 20,  77 => 19,  73 => 18,  69 => 17,  65 => 16,  61 => 15,  57 => 14,  52 => 12,  48 => 11,  44 => 10,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/views.overview.html.twig", "/opt/drupal/web/core/modules/views/help_topics/views.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 9);
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
