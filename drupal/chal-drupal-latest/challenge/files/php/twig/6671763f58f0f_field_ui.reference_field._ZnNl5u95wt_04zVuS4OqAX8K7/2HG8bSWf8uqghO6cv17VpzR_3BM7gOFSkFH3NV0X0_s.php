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

/* @help_topics/field_ui.reference_field.html.twig */
class __TwigTemplate_fa10f92e67720410def3277904b54096 extends Template
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
        // line 9
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 10
        ob_start(function () { return ''; });
        echo t("Content types", array());
        $context["content_types_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 11
        $context["content_types_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["content_types_link_text"] ?? null), 11, $this->source), "entity.node_type.collection"));
        // line 12
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 13
        echo t("Add an entity reference field to an entity sub-type; see @content_structure_topic for more information on entities and reference fields.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 14
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 16
        echo t("Navigate to the page for managing the entity sub-type you want to add the field to. For example, to add a field to a content type, in the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>@content_types_link</em>.", array("@content_types_link" => ($context["content_types_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 17
        echo t("Find the particular sub-type that you want to add the field to, and click <em>Manage fields</em>.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("Click <em>Add field</em>.", array());
        echo "</li>
  <li>";
        // line 19
        echo t("In <em>Add a new field</em>, select the type of reference field you want to add. The <em>Reference</em> section of the select list shows the most common types of reference field; choose <em>Other...</em> if the entity type you want to reference is not listed.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("The <em>Label</em> field should now be visible; enter a label for the field, which is used as the field label for both content editing and content display.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Click <em>Save and continue</em>.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("On the next screen, verify that the type of entity you want to reference is shown in <em>Type of item to reference</em>, or select it if not. Enter a value for <em>Allowed number of values</em>. You can limit the field to one value per entity item, a set number of values, or set it to have unlimited values. Click <em>Save field settings</em>.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("On the next screen, optionally edit the settings for <em>Label</em>, <em>Help text</em> (text to be displayed below the field on the content editing page), and <em>Required field</em> (to make it so a value must be entered in order to save the content when editing).", array());
        echo "</li>
  <li>";
        // line 24
        echo t("In the <em>Reference type</em> section, you will usually want to limit the entity sub-types that can be referenced; for example, if you are creating a <em>Content</em> reference, you can check one or two <em>Content type</em> choices. The choices will be easier for content editors to scan if you also choose a sort value (normally the entity title or label field).", array());
        echo "</li>
  <li>";
        // line 25
        echo t("Click <em>Save settings</em>. You should be returned to the <em>Manage fields</em> page, with your new field in the list.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/field_ui.reference_field.html.twig";
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
        return array (  97 => 25,  93 => 24,  89 => 23,  85 => 22,  81 => 21,  77 => 20,  73 => 19,  69 => 18,  65 => 17,  61 => 16,  56 => 14,  52 => 13,  47 => 12,  45 => 11,  41 => 10,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/field_ui.reference_field.html.twig", "/opt/drupal/web/core/modules/field_ui/help_topics/field_ui.reference_field.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 9, "trans" => 10);
        static $filters = array("escape" => 13);
        static $functions = array("render_var" => 9, "help_topic_link" => 9, "help_route_link" => 11);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link', 'help_route_link']
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
