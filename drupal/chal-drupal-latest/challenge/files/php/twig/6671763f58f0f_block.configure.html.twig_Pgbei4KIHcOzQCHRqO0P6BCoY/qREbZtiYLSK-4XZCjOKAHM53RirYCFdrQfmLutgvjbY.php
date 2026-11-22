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

/* @help_topics/block.configure.html.twig */
class __TwigTemplate_86e59a438cd46015500c4ebc04c5b59b extends Template
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
        ob_start(function () { return ''; });
        echo t("Block layout", array());
        $context["layout_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["layout_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["layout_link_text"] ?? null), 8, $this->source), "block.admin_display"));
        // line 9
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 10
        echo t("Configure the settings of a block that was previously placed in a region of a theme.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 13
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>@layout_link</em>.", array("@layout_link" => ($context["layout_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 14
        echo t("Click the name of the theme that contains the block.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("Optionally, click <em>Demonstrate block regions</em> to see the regions of the theme.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("If you only want to change the region where a block is located, or the ordering of blocks within a region, drag blocks to their desired positions and click <em>Save blocks</em>.", array());
        echo "</li>
<li>";
        // line 17
        echo t("If you want to change additional settings, find the region where the block you want to update is currently located, and click <em>Configure</em> in the line of the block description.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("Edit the block's settings. The available settings vary depending on the module that provides the block, but for all blocks you can change:", array());
        // line 19
        echo "    <ul>
      <li>";
        // line 20
        echo t("<em>Block title</em>: The heading for the block on your site -- for some blocks, you will need to check the <em>Override title</em> checkbox in order to enter a title", array());
        echo "</li>
      <li>";
        // line 21
        echo t("<em>Display title</em>: Check the box if you want the title displayed", array());
        echo "</li>
      <li>";
        // line 22
        echo t("<em>Visibility</em>: Add conditions for when the block should be displayed", array());
        echo "</li>
      <li>";
        // line 23
        echo t("<em>Region</em>: Change the theme region the block is displayed in", array());
        echo "</li>
    </ul>
  </li>
  <li>";
        // line 26
        echo t("Click <em>Save block</em>.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/block.configure.html.twig";
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
        return array (  102 => 26,  96 => 23,  92 => 22,  88 => 21,  84 => 20,  81 => 19,  79 => 18,  75 => 17,  71 => 16,  67 => 15,  63 => 14,  59 => 13,  54 => 11,  50 => 10,  45 => 9,  43 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/block.configure.html.twig", "/opt/drupal/web/core/modules/block/help_topics/block.configure.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 13);
        static $functions = array("render_var" => 8, "help_route_link" => 8);

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
