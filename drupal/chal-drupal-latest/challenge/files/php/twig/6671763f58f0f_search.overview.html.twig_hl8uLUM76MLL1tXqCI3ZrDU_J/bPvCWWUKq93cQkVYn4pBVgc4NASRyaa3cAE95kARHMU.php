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

/* @help_topics/search.overview.html.twig */
class __TwigTemplate_ec99b2181a0eeb8180c54aed5d707a5a extends Template
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
        echo t("Search", array());
        $context["search_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        $context["search_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["search_link_text"] ?? null), 9, $this->source), "search.view"));
        // line 10
        $context["user_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("user.overview"));
        // line 11
        echo "<h2>";
        echo t("What are search pages?", array());
        echo "</h2>
<p>";
        // line 12
        echo t("The core Search module organizes site search into <em>pages</em>. Each page allows users to search a particular type of content with a particular configuration. The configuration includes specifying a URL that starts with <em>search</em>, a name for the page, and additional options for some search page types.", array());
        echo "</p>
<p>";
        // line 13
        echo t("When users visit the main search page (see @search_link), they will see the configured search pages that they have access to. Each search page has a search form on it, and the page will display search results after the user enters keywords into the form and clicks the search button.", array("@search_link" => ($context["search_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 14
        echo t("What modules provide site search?", array());
        echo "</h2>
<p>";
        // line 15
        echo t("The core Search module provides the ability to configure search pages; search page types are provided by both core and contributed modules. The core modules that provide search page types are:", array());
        echo "</p>
<ul>
  <li>";
        // line 17
        echo t("The Node module, for searching content pages", array());
        echo "</li>
  <li>";
        // line 18
        echo t("The User module, for searching user profiles", array());
        echo "</li>
  <li>";
        // line 19
        echo t("The Help module, for searching help topics", array());
        echo "</li>
</ul>
<p>";
        // line 21
        echo t("As an alternative to the core Search module's system of search pages, you can use contributed modules to provide site search. For example, the <a href=\"https://www.drupal.org/project/apachesolr\">Apache Solr</a> and <a href=\"https://www.drupal.org/project/sphinx\">Sphinx</a> contributed modules use third-party technology to provide site search.", array());
        echo "</p>
<h2>";
        // line 22
        echo t("What are the limitations of the core Search module?", array());
        echo "</h2>
<p>";
        // line 23
        echo t("There are two main limitations of the core Search module. First, it is not appropriate for very large sites -- if you have a large site, look into other search technologies like Apache Solr. Second, the Node search page type only supports exact keyword matching, which is not the behavior that most users will expect. You can improve this by installing a language-specific stemming module for your language (such as <a href=\"https://www.drupal.org/project/porterstemmer\">Porter Stemmer</a> for American English), which makes it so that, for example, a search for the word walk would match pages containing the words walk, walking, and walked.", array());
        echo "</p>
<h2>";
        // line 24
        echo t("What are the search permissions?", array());
        echo "</h2>
<ul>
<li>";
        // line 26
        echo t("Users with <em>Use search</em> permission can use the <em>Search form</em> block and <em>Search</em> page; this permission is required for any search configured in the core Search module.", array());
        echo "</li>
<li>";
        // line 27
        echo t("In addition to <em>Use search</em>, <em>View user information</em> permission is needed for searching users.", array());
        echo "</li>
<li>";
        // line 28
        echo t("In addition to <em>Use search</em>, <em>View published content</em> permission is needed for searching content.", array());
        echo "</li>
<li>";
        // line 29
        echo t("Users with <em>Use advanced search</em> permission can use more complex search filtering when performing content searches.", array());
        echo "</li>
</ul>
<h2>";
        // line 31
        echo t("Configuring site search overview", array());
        echo "</h2>
<p>";
        // line 32
        echo t("In order to configure site search using the core Search module, you will need to configure one or more search pages. You will also need to verify or alter permissions so that the desired user roles can search the site. (See @user_overview_topic for more information about roles and permissions.) For content search, you will also need to make sure that the search index is configured and that the site is fully indexed. Finally, you may wish to place the <em>Search form</em> block on pages of your site, or add the search page to a navigation menu, to give users easy access to search. See the related topics listed below for specific tasks.", array("@user_overview_topic" => ($context["user_overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 33
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li>";
        // line 35
        echo t("<a href=\"https://www.drupal.org/documentation/modules/search\">Online documentation for the Search module</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/search.overview.html.twig";
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
        return array (  129 => 35,  124 => 33,  120 => 32,  116 => 31,  111 => 29,  107 => 28,  103 => 27,  99 => 26,  94 => 24,  90 => 23,  86 => 22,  82 => 21,  77 => 19,  73 => 18,  69 => 17,  64 => 15,  60 => 14,  56 => 13,  52 => 12,  47 => 11,  45 => 10,  43 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/search.overview.html.twig", "/opt/drupal/web/core/modules/search/help_topics/search.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 8);
        static $filters = array("escape" => 13);
        static $functions = array("render_var" => 9, "help_route_link" => 9, "help_topic_link" => 10);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link', 'help_topic_link']
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
