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

/* @help_topics/node.overview.html.twig */
class __TwigTemplate_d89952b7be89543df721749e5acb8c39 extends Template
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
        // line 13
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 14
        echo "<h2>";
        echo t("What is a content item?", array());
        echo "</h2>
<p>";
        // line 15
        echo t("A <em>content item</em> is a type of content entity for page-level content, which can have fields that store text, HTML markup, images, attached files, and other data. See @content_structure_topic for more about content entities and fields.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 16
        echo t("What is a content type?", array());
        echo "</h2>
<p>";
        // line 17
        echo t("Content items are divided into <em>content types</em>, which are the entity sub-types for the content item entity type; each content type has its own fields and display settings. For example, you might set up content types for pages, articles, recipes, events, and blog entries on your web site.", array());
        echo "</p>
<h2>";
        // line 18
        echo t("Overview of managing content", array());
        echo "</h2>
<p>";
        // line 19
        echo t("The core Node module allows you to define content types, and add and edit content items. The core Field UI module allows you to attach fields to each content type and manage the edit form and display for each content type. See the related topics listed below for specific tasks. Many other core and contributed modules and installation profiles provide pre-defined content types, modify the permission structure for content items, and provide other functionality.", array());
        echo "</p>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/node.overview.html.twig";
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
        return array (  62 => 19,  58 => 18,  54 => 17,  50 => 16,  46 => 15,  41 => 14,  39 => 13,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/node.overview.html.twig", "/opt/drupal/web/core/modules/node/help_topics/node.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 13, "trans" => 14);
        static $filters = array("escape" => 15);
        static $functions = array("render_var" => 13, "help_topic_link" => 13);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link']
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
