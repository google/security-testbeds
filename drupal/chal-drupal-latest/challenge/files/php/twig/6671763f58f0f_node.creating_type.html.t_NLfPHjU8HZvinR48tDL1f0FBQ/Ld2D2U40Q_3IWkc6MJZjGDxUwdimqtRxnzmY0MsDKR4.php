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

/* @help_topics/node.creating_type.html.twig */
class __TwigTemplate_7f7b14ea061807cc36beeb2854a521f9 extends Template
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
        // line 10
        ob_start(function () { return ''; });
        // line 11
        echo "  ";
        echo t("Administer content types", array());
        $context["content_permissions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 13
        $context["content_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["content_permissions_link_text"] ?? null), 13, $this->source), "user.admin_permissions.module", ["modules" => "node"]));
        // line 14
        ob_start(function () { return ''; });
        // line 15
        echo "  ";
        echo t("Content types", array());
        $context["content_types_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 17
        $context["content_types_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["content_types_link_text"] ?? null), 17, $this->source), "entity.node_type.collection"));
        // line 18
        $context["content_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("node.overview"));
        // line 19
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 20
        echo t("Create a new content type. See @content_overview_topic for more about content types.", array("@content_overview_topic" => ($context["content_overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 21
        echo t("Who can create a content type?", array());
        echo "</h2>
<p>";
        // line 22
        echo t("Users with the <em>@content_permissions_link</em> permission (typically administrators) can create new content types.", array("@content_permissions_link" => ($context["content_permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 23
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 25
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>@content_types_link</em>.", array("@content_types_link" => ($context["content_types_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 26
        echo t("Click <em>Add content type.</em>", array());
        echo "</li>
  <li>";
        // line 27
        echo t("In the <em>Name</em> field, enter a name for the content type, which is how it will be listed in the administrative interface.", array());
        echo "</li>
  <li>";
        // line 28
        echo t("Optionally, enter a <em>Description</em> for the content type. You may also want to adjust some of the settings in the vertical tabs section of the edit page.", array());
        echo "</li>
  <li>";
        // line 29
        echo t("Click <em>Save and manage fields</em>. Your content type will be created, and assuming you have the core Field UI module installed, you will be taken to the <em>Manage fields</em> page for the content type. (If you do not have the core Field UI module installed, the button will say <em>Save</em> instead.)", array());
        echo "</li>
  <li>";
        // line 30
        echo t("If you have the core Field UI module installed, follow the steps in the related topics to add fields to the new content type, set up the editing form, and configure the display.", array());
        echo "</li>
</ol>
<h2>";
        // line 32
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/structure-content-type.html\">";
        // line 34
        echo t("Adding a Content Type (Drupal User Guide)", array());
        echo "</a></li>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/content-structure-chapter.html\">";
        // line 35
        echo t("Setting Up Content Structure (Drupal User Guide)", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/node.creating_type.html.twig";
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
        return array (  113 => 35,  109 => 34,  104 => 32,  99 => 30,  95 => 29,  91 => 28,  87 => 27,  83 => 26,  79 => 25,  74 => 23,  70 => 22,  66 => 21,  62 => 20,  57 => 19,  55 => 18,  53 => 17,  49 => 15,  47 => 14,  45 => 13,  41 => 11,  39 => 10,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/node.creating_type.html.twig", "/opt/drupal/web/core/modules/node/help_topics/node.creating_type.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 10, "trans" => 11);
        static $filters = array("escape" => 20);
        static $functions = array("render_var" => 13, "help_route_link" => 13, "help_topic_link" => 18);

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
