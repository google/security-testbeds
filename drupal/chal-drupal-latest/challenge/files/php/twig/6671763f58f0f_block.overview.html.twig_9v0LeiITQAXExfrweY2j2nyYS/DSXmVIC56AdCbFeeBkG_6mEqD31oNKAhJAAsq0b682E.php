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

/* @help_topics/block.overview.html.twig */
class __TwigTemplate_887bf858168ffa37647e9b46b735e97d extends Template
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
        echo t("What are blocks?", array());
        echo "</h2>
<p>";
        // line 8
        echo t("Blocks are boxes of content rendered into an area, or region, of a web page of your site. Blocks are placed and configured specifically for each theme.", array());
        echo "</p>
<h2>";
        // line 9
        echo t("What are content blocks?", array());
        echo "</h2>
<p>";
        // line 10
        echo t("Content blocks are blocks whose content you can edit. You can define one or more <em>block types</em>, and attach fields to each block type. Content blocks can be placed just like blocks provided by other modules.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("What is the block description?", array());
        echo "</h2>
<p>";
        // line 12
        echo t("The block description is an identification name for a block, which is shown in the administrative interface. It is not displayed on the site.", array());
        echo "</p>
<h2>";
        // line 13
        echo t("What is the block title?", array());
        echo "</h2>
<p>";
        // line 14
        echo t("The block title is the heading that is optionally shown to site visitors when the block is placed in a region.", array());
        echo "</p>
<h2>";
        // line 15
        echo t("Overview for managing blocks", array());
        echo "</h2>
<p>";
        // line 16
        echo t("The <em>Block</em> module allows you to place blocks in regions of your installed themes, and configure block settings. The <em>Block Content</em> module allows you to manage block types and content blocks. See the related topics listed below for specific tasks.", array());
        echo "</p>
<h2>";
        // line 17
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li>";
        // line 19
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/blocks-chapter.html\">Blocks (Drupal User Guide)</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/block.overview.html.twig";
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
        return array (  85 => 19,  80 => 17,  76 => 16,  72 => 15,  68 => 14,  64 => 13,  60 => 12,  56 => 11,  52 => 10,  48 => 9,  44 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/block.overview.html.twig", "/opt/drupal/web/core/modules/block/help_topics/block.overview.html.twig");
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
