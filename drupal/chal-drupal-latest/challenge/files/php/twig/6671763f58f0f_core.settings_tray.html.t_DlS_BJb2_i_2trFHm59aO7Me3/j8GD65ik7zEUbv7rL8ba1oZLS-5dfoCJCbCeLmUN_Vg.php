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

/* @help_topics/core.settings_tray.html.twig */
class __TwigTemplate_24cb5c676bfd0ae309eac354e00364c5 extends Template
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
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 7
        echo t("Edit settings in place.", array());
        echo "</p>
<h2>";
        // line 8
        echo t("What is quick editing?", array());
        echo "</h2>
<p>";
        // line 9
        echo t("The core Settings Tray module provides the ability to quickly edit settings inline. It requires the core Contextual Links module in order to expose the links that let you edit in place.", array());
        echo "</p>
<h2>";
        // line 10
        echo t("Who can edit settings in place?", array());
        echo "</h2>
<p>";
        // line 11
        echo t("In order to follow these steps to edit settings in place, the core Settings Tray module must be installed. Also, either the core Toolbar module or a contributed replacement must be installed. You will need to have <em>Use contextual links</em> permission, as well as permission to edit the particular content or settings.", array());
        echo "</p>
<h2>";
        // line 12
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 14
        echo t("Find and visit a page on your site that has the settings that you would like to edit.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("Click the contextual links <em>Edit</em> button on the toolbar (in most themes, it looks like a pencil). Contextual <em>Edit</em> links with the same icon will appear all over your page.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("Find the contextual link for the part of the page you want to edit. For example, if you want to edit the settings for a block, the link should be in the top-right corner of the block, or top-left for right-to-left languages.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("Click the link to open the contextual links menu, and click <em>Quick edit</em>. An editing form for the settings should appear on the page.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("Make your edits and submit the form.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.settings_tray.html.twig";
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
        return array (  85 => 18,  81 => 17,  77 => 16,  73 => 15,  69 => 14,  64 => 12,  60 => 11,  56 => 10,  52 => 9,  48 => 8,  44 => 7,  39 => 6,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.settings_tray.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.settings_tray.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 6);
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
