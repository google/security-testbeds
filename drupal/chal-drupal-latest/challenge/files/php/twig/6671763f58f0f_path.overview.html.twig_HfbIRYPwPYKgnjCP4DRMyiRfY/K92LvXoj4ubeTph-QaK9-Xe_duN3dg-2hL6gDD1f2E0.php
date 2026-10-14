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

/* @help_topics/path.overview.html.twig */
class __TwigTemplate_a1e29620d0876c9180469c8c2848aa26 extends Template
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
        echo "<h2>";
        echo t("What is a URL?", array());
        echo "</h2>
<p>";
        // line 9
        echo t("URL is the abbreviation for \"Uniform Resource Locator\", which is the page's address on the web. It is the \"name\" by which a browser identifies a page to display. In the example \"Visit us at <em>example.com</em>.\", <em>https://example.com</em> would be the URL for the home page of your website. Users use URLs to locate content on the web.", array());
        echo "</p>
<h2>";
        // line 10
        echo t("What is a path?", array());
        echo "</h2>
<p>";
        // line 11
        echo t("A path is the unique, last part of the URL for a specific function or piece of content. For example, for a page whose full URL is <em>https://example.com/node/7</em>, the path is <em>node/7</em>. Here are some examples of paths you might find in your site:", array());
        echo "</p>
<ul>
  <li>";
        // line 13
        echo t("node/7: Path to a particular content item.", array());
        echo "</li>
  <li>";
        // line 14
        echo t("taxonomy/term/6: Path to a taxonomy term page.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("user/3: Path to a user profile page.", array());
        echo "</li>
</ul>
<h2>";
        // line 17
        echo t("What is an alias?", array());
        echo "</h2>
<p>";
        // line 18
        echo t("The core software allows you to provide more understandable URLs for pages on your site, which are called <em>aliases</em>. For example, if you have an \"About Us\" page with the path <em>node/7</em>, you can set up an alias of <em>about</em> so that your visitors will see it as <em>https://www.example.com/about</em>.", array());
        echo "</p>
<h2>";
        // line 19
        echo t("Overview of configuring paths, aliases, and URLs", array());
        echo "</h2>
<p>";
        // line 20
        echo t("The core Path module provides the URL aliasing functionality. The contributed <a href=\"https://www.drupal.org/project/pathauto\">Pathauto</a> module allows you to configure automatically-generated URL aliases for content items and other pages. See the related topics listed below for specific tasks.", array());
        echo "</p>
<h2>";
        // line 21
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/content-paths.html\">";
        // line 23
        echo t("Concept: Paths, Aliases, and URLs (Drupal User Guide)", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/path.overview.html.twig";
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
        return array (  91 => 23,  86 => 21,  82 => 20,  78 => 19,  74 => 18,  70 => 17,  65 => 15,  61 => 14,  57 => 13,  52 => 11,  48 => 10,  44 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/path.overview.html.twig", "/opt/drupal/web/core/modules/path/help_topics/path.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 8);
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
