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

/* @help_topics/core.menus.html.twig */
class __TwigTemplate_a134fd4862728fe4d39d1038813dd760 extends Template
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
        echo "<h2>";
        echo t("What is a menu?", array());
        echo "</h2>
<p>";
        // line 8
        echo t("A menu is a collection of <em>menu links</em> used to navigate a web site. Menus and menu links can be provided by modules or site administrators.", array());
        echo "</p>
<h2>";
        // line 9
        echo t("Managing menus overview", array());
        echo "</h2>
<p>";
        // line 10
        echo t("The core Menu UI module provides a user interface for managing menus, including creating new menus, reordering menu links, and disabling links provided by modules. It also provides the ability for links to content items to be added to menus while editing, if configured on the content type. The core Custom Menu Links module provides the ability to add custom links to menus. Each menu can be displayed by placing a block in a theme region; some themes also can display a menu outside of the block system. See the related topics listed below for specific tasks.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("Additional Resources", array());
        echo "</h2>
<ul>
  <li>";
        // line 13
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/menu-concept.html\">Concept: Menu (Drupal User Guide)</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.menus.html.twig";
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
        return array (  61 => 13,  56 => 11,  52 => 10,  48 => 9,  44 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.menus.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.menus.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 7);
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
