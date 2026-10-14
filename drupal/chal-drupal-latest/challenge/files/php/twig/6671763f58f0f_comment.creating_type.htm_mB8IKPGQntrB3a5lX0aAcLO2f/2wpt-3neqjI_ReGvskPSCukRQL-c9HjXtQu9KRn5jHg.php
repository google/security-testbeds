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

/* @help_topics/comment.creating_type.html.twig */
class __TwigTemplate_61d0e32473681623636937c23d6314b8 extends Template
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
        echo t("Comment types", array());
        $context["comment_types_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 13
        $context["comment_types_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["comment_types_link_text"] ?? null), 13, $this->source), "entity.comment_type.collection"));
        // line 14
        ob_start(function () { return ''; });
        // line 15
        echo "  ";
        echo t("Administer comment types and settings", array());
        $context["comment_permissions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 17
        $context["comment_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["comment_permissions_link_text"] ?? null), 17, $this->source), "user.admin_permissions.module", ["modules" => "comment"]));
        // line 18
        $context["comment_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("comment.overview"));
        // line 19
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 20
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 21
        echo t("Create a new comment type. See @comment_overview_topic for information about comments and comment types.", array("@comment_overview_topic" => ($context["comment_overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 22
        echo t("Who can create a comment type?", array());
        echo "</h2>
<p>";
        // line 23
        echo t("Users with the <em>@comment_permissions_link</em> permission (typically administrators) can create comment types.", array("@comment_permissions_link" => ($context["comment_permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 24
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 26
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>@comment_types_link</em>.", array("@comment_types_link" => ($context["comment_types_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 27
        echo t("Click <em>Add comment type</em>.", array());
        echo "</li>
  <li>";
        // line 28
        echo t("In the <em>Label</em> field, enter a name for the comment type, which is how it will be listed in the administrative interface.", array());
        echo "</li>
  <li>";
        // line 29
        echo t("In the <em>Target entity type</em> field, select the entity type to be commented on. See @content_structure_topic for more about content entities and fields.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 30
        echo t("Click <em>Save</em>. The comment type will be created.", array());
        echo "</li>
  <li>";
        // line 31
        echo t("Optionally, if you have the core Field UI module installed you can follow the steps in the related topics to add fields to the new comment type, set up the editing form, and configure the display.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/comment.creating_type.html.twig";
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
        return array (  101 => 31,  97 => 30,  93 => 29,  89 => 28,  85 => 27,  81 => 26,  76 => 24,  72 => 23,  68 => 22,  64 => 21,  59 => 20,  57 => 19,  55 => 18,  53 => 17,  49 => 15,  47 => 14,  45 => 13,  41 => 11,  39 => 10,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/comment.creating_type.html.twig", "/opt/drupal/web/core/modules/comment/help_topics/comment.creating_type.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 10, "trans" => 11);
        static $filters = array("escape" => 21);
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
