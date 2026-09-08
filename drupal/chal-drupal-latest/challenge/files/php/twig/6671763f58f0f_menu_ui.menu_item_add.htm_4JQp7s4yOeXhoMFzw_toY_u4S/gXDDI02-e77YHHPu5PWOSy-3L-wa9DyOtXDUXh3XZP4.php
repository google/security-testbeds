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

/* @help_topics/menu_ui.menu_item_add.html.twig */
class __TwigTemplate_0398969db8b8c12aaa780b49163f9e65 extends Template
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
        echo t("Menus", array());
        $context["structure_menu_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        $context["structure_menu_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["structure_menu_text"] ?? null), 9, $this->source), "entity.menu.collection"));
        // line 10
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 11
        echo t("Add a link to a menu. Note that you can also add a link to a menu from the content edit page if menu settings have been configured for the content type.", array());
        echo "</p>
<h2>";
        // line 12
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 14
        echo t("In the <em>Manage</em> administration menu, navigate to <em>Structure</em> &gt; @structure_menu_link.", array("@structure_menu_link" => ($context["structure_menu_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 15
        echo t("Locate the desired menu and click <em>Add link</em> in the <em>Operations</em> list.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("Enter the <em>Menu link title</em> to be displayed.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("Enter the <em>Link</em>, one of the following:", array());
        // line 18
        echo "    <ul>
      <li>";
        // line 19
        echo t("An internal path, such as <em>/node/add</em>", array());
        echo "</li>
      <li>";
        // line 20
        echo t("A full external URL", array());
        echo "</li>
      <li>";
        // line 21
        echo t("Start typing the title of a content item and select it when the full title comes up", array());
        echo "</li>
      <li>";
        // line 22
        echo t("<em>&lt;nolink&gt;</em> to display the <em>Menu link title</em> as plain text without a link", array());
        echo "</li>
      <li>";
        // line 23
        echo t("<em>&lt;front&gt;</em> to link to the front page of your site", array());
        echo "</li>
    </ul>
  </li>
  <li>";
        // line 26
        echo t("Make sure that <em>Enabled</em> is checked; if not, the menu link will not be displayed.", array());
        echo "</li>
  <li>";
        // line 27
        echo t("Optionally, enter a <em>Description</em>, which will be displayed when a user hovers over the link.", array());
        echo "</li>
  <li>";
        // line 28
        echo t("Optionally, check <em>Show as expanded</em> to automatically show the children of this link (if any) when this link is shown.", array());
        echo "</li>
  <li>";
        // line 29
        echo t("Optionally, select the <em>Parent link</em>, if this menu link should be a child of another menu link.", array());
        echo "</li>
  <li>";
        // line 30
        echo t("Click <em>Save</em>. You will be returned to the <em>Add link</em> page to add another link.", array());
        echo "</li>
  <li>";
        // line 31
        echo t("In the <em>Manage</em> administration menu, navigate to <em>Structure</em> &gt; @structure_menu_link.", array("@structure_menu_link" => ($context["structure_menu_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 32
        echo t("Locate the menu you just added a link to and click <em>Edit</em> in the <em>Operations</em> list.", array());
        echo "</li>
  <li>";
        // line 33
        echo t("Verify that the order of links is correct. If it is not, drag menu links until the order is correct, and click <em>Save</em>.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/menu_ui.menu_item_add.html.twig";
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
        return array (  126 => 33,  122 => 32,  118 => 31,  114 => 30,  110 => 29,  106 => 28,  102 => 27,  98 => 26,  92 => 23,  88 => 22,  84 => 21,  80 => 20,  76 => 19,  73 => 18,  71 => 17,  67 => 16,  63 => 15,  59 => 14,  54 => 12,  50 => 11,  45 => 10,  43 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/menu_ui.menu_item_add.html.twig", "/opt/drupal/web/core/modules/menu_ui/help_topics/menu_ui.menu_item_add.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 8);
        static $filters = array("escape" => 14);
        static $functions = array("render_var" => 9, "help_route_link" => 9);

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
