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

/* @help_topics/field_ui.add_field.html.twig */
class __TwigTemplate_b70f08a2bd447568a84a017e56a6e734 extends Template
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
        echo t("Content types", array());
        $context["content_types_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        $context["content_types_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["content_types_link_text"] ?? null), 9, $this->source), "entity.node_type.collection"));
        // line 10
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 11
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 12
        echo t("Add a field to an entity sub-type; see @content_structure_topic for an overview of entity types and sub-types, as well as an overview of field types.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 13
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 15
        echo t("Navigate to the page for managing the entity sub-type you want to add the field to. For example, to add a field to a content type, in the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>@content_types_link</em>.", array("@content_types_link" => ($context["content_types_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 16
        echo t("Find the particular sub-type that you want to add the field to, and click <em>Manage fields</em>.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("Click <em>Add field</em>.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("In <em>Add a new field</em>, select the type of field you want to add; see @content_structure_topic for an overview of field types.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 19
        echo t("The <em>Label</em> field should now be visible; enter a label for the field, which is used as the field label for both content editing and content display.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("Click <em>Save and continue</em>.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("On the next screen, enter a value for <em>Allowed number of values</em>. You can limit the field to one value per entity item, a set number of values, or set it to have unlimited values. Click <em>Save field settings</em>.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("On the next screen, optionally edit the settings for the field, which vary depending on what field type you are creating. For all fields, you can edit the <em>Label</em>, <em>Help text</em> (text to be displayed below the field on the content editing page), and <em>Required field</em> (to make it so a value must be entered in order to save the content when editing). You can also configure a default value for the field.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("Click <em>Save settings</em>. You should be returned to the <em>Manage fields</em> page, with your new field in the list.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/field_ui.add_field.html.twig";
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
        return array (  93 => 23,  89 => 22,  85 => 21,  81 => 20,  77 => 19,  73 => 18,  69 => 17,  65 => 16,  61 => 15,  56 => 13,  52 => 12,  47 => 11,  45 => 10,  43 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/field_ui.add_field.html.twig", "/opt/drupal/web/core/modules/field_ui/help_topics/field_ui.add_field.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 8);
        static $filters = array("escape" => 12);
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
