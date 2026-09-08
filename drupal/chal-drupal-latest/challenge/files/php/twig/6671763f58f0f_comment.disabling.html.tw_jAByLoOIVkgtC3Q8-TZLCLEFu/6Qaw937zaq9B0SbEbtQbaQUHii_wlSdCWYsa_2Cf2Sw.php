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

/* @help_topics/comment.disabling.html.twig */
class __TwigTemplate_48384fa1d7ca1c848fa3fc84b753456b extends Template
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
        // line 8
        echo t("Administer comments and comment settings", array());
        $context["comment_permissions_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["comment_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["comment_permissions_text"] ?? null), 10, $this->source), "user.admin_permissions.module", ["modules" => "comment"]));
        // line 11
        $context["comment_config_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("comment.configuring"));
        // line 12
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 13
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 14
        echo t("Turn off commenting for a particular entity (see @content_structure_topic for more about content entities and fields). Note that if you want to turn off commenting for all entities of an entity type or subtype, you will need to edit the field settings for the comment field; see @comment_config_topic for more about configuring the comment field.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), "@comment_config_topic" => ($context["comment_config_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 15
        echo t("Who can disable comments?", array());
        echo "</h2>
<p>";
        // line 16
        echo t("You will need the <em>@comment_permissions_link</em> permission in order to disable commenting. You will also need permission to edit the entity that the comments are on.", array("@comment_permissions_link" => ($context["comment_permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 17
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 19
        echo t("Find the entity you want to disable comments for, and edit it. For example, to turn off comments on a content item, you could find it by navigating in the <em>Manage</em> administrative menu to <em>Content</em>, filtering to find the content item, and clicking <em>Edit</em>.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("Under <em>Comment settings</em>, select the desired comment setting:", array());
        // line 21
        echo "    <ul>
      <li>";
        // line 22
        echo t("<em>Open</em>: comments are allowed.", array());
        echo "</li>
      <li>";
        // line 23
        echo t("<em>Closed</em>: past comments remain visible, but no new comments are allowed.", array());
        echo "</li>
      <li>";
        // line 24
        echo t("<em>Hidden</em>: past comments are hidden, and no new comments are allowed.", array());
        echo "</li>
    </ul>
  </li>
  <li>";
        // line 27
        echo t("Save the entity.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/comment.disabling.html.twig";
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
        return array (  95 => 27,  89 => 24,  85 => 23,  81 => 22,  78 => 21,  76 => 20,  72 => 19,  67 => 17,  63 => 16,  59 => 15,  55 => 14,  50 => 13,  48 => 12,  46 => 11,  44 => 10,  41 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/comment.disabling.html.twig", "/opt/drupal/web/core/modules/comment/help_topics/comment.disabling.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 8);
        static $filters = array("escape" => 14);
        static $functions = array("render_var" => 10, "help_route_link" => 10, "help_topic_link" => 11);

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
