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

/* @help_topics/core.extending.html.twig */
class __TwigTemplate_5a5cc9d4bf62331157087849c48b61ef extends Template
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
        echo t("What is a module?", array());
        echo "</h2>
<p>";
        // line 6
        echo t("A <em>module</em> is a set of PHP, JavaScript, and/or CSS files that extends site features and adds functionality. A set of <em>Core modules</em> is distributed as part of the core software download. Additional <em>Contributed modules</em> can be downloaded separately from the <a href=\"https://www.drupal.org/project/project_module\">Download &amp; Extend page on drupal.org</a>.", array());
        echo "</p>
<h2>";
        // line 7
        echo t("What is an Experimental module?", array());
        echo "</h2>
<p>";
        // line 8
        echo t("An <em>Experimental</em> module is a module that is still in development and is not yet stable. Using Experimental modules on production sites is not recommended.", array());
        echo "</p>
<h2>";
        // line 9
        echo t("What are installing and uninstalling?", array());
        echo "</h2>
<p>";
        // line 10
        echo t("Installing a core or downloaded contributed module means turning it on, so that you can use its features and functionality. Uninstalling means turning it off and removing all of its configuration. A module cannot be uninstalled if another installed module depends on it, or if you have created content on your site using the module -- you would need to delete the content and uninstall dependent modules first.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("Extending overview", array());
        echo "</h2>
<p>";
        // line 12
        echo t("See the related topics listed below for help performing tasks related to extending the functionality of your site.", array());
        echo "</p>
<h2>";
        // line 13
        echo t("Additional resources", array());
        echo "</h2>
<ul>
    <li>";
        // line 15
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/understanding-modules.html\">Concept: Modules (Drupal User Guide)</a>", array());
        echo "</li>
    <li>";
        // line 16
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/extend-chapter.html\">Extending and Customizing Your Site (Drupal User Guide)</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.extending.html.twig";
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
        return array (  81 => 16,  77 => 15,  72 => 13,  68 => 12,  64 => 11,  60 => 10,  56 => 9,  52 => 8,  48 => 7,  44 => 6,  39 => 5,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.extending.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.extending.html.twig");
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
