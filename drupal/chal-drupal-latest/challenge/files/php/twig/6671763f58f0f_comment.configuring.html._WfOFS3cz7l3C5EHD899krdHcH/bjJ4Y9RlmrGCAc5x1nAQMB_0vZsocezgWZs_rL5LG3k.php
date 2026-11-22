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

/* @help_topics/comment.configuring.html.twig */
class __TwigTemplate_24174fd40137ccbab1a8f761876c62a9 extends Template
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
        ob_start(function () { return ''; });
        // line 10
        echo t("Administer comments and comment settings", array());
        $context["comment_permissions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        $context["comment_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["comment_permissions_link_text"] ?? null), 12, $this->source), "user.admin_permissions.module", ["modules" => "comment"]));
        // line 13
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 14
        $context["comment_type_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("comment.creating_type"));
        // line 15
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 16
        echo t("Configure a content entity type/subtype to allow commenting, using a comment type that you have configured. See @content_structure_topic for more about content entities and fields, and @comment_type_topic to configure a comment type.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), "@comment_type_topic" => ($context["comment_type_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 17
        echo t("Who can configure comments?", array());
        echo "</h2>
<p>";
        // line 18
        echo t("In order to follow these steps, the Field UI module must be installed. You'll need the Comment module's <em>@comment_permissions_link</em> permission, in order to change comment settings for a comment field. You'll also need to have the appropriate permission for adding fields to the entity type or subtype that the comments are attached to. For example, to add a comment field to content items provided by the Node module, you would need the Node module's <em>Administer content types</em> permission.", array("@comment_permissions_link" => ($context["comment_permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 19
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 21
        echo t("Follow the steps in the related <em>Adding a field to an entity sub-type</em> topic to add a field of type <em>Comments</em> to the desired entity type or sub-type.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("On the first field settings page, choose the <em>Comment type</em> to use for this entity type or sub-type. You'll also notice that the <em>Allowed number of values</em> field cannot be changed for comment fields.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("On the next field settings page, enter the desired settings for the comment field:", array());
        // line 24
        echo "    <ul>
      <li>";
        // line 25
        echo t("<em>Threading</em>: whether or not the comments are collected by threads, with people able to reply to particular comments instead of to the content entity itself.", array());
        echo "</li>
      <li>";
        // line 26
        echo t("<em>Comments per page</em>: the maximum number of comments displayed on one page (a pager will be added if you exceed this limit).", array());
        echo "</li>
      <li>";
        // line 27
        echo t("<em>Anonymous commenting</em>: whether or not anonymous commenters are allowed or required to leave contact information with their comments (only applies if anonymous users have permission to post comments).", array());
        echo "</li>
      <li>";
        // line 28
        echo t("<em>Show reply form on the same page as comments</em>: whether the comment reply form is displayed on the same page as the comments. If this is not selected, clicking <em>Reply</em> will open a new page with the reply form.", array());
        echo "</li>
      <li>";
        // line 29
        echo t("<em>Preview comments</em>: whether previewing comments before submission is <em>Required</em>, <em>Optional</em>, or <em>Disabled</em>.", array());
        echo "</li>
      <li>";
        // line 30
        echo t("<em>Default value</em>: each individual entity has its own comment settings, but here you can set defaults for the comment settings for this entity type or subtype. The comment settings values are:", array());
        // line 31
        echo "        <ul>
          <li>";
        // line 32
        echo t("<em>Open</em>: comments are allowed.", array());
        echo "</li>
          <li>";
        // line 33
        echo t("<em>Closed</em>: past comments remain visible, but no new comments are allowed.", array());
        echo "</li>
          <li>";
        // line 34
        echo t("<em>Hidden</em>: past comments are hidden, and no new comments are allowed.", array());
        echo "</li>
        </ul>
      </li>
    </ul>
  </li>
</ol>
<h2>";
        // line 40
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/8/core/modules/comment/administering-a-content-types-comment-settings\">";
        // line 42
        echo t("Online documentation for content comment settings", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/comment.configuring.html.twig";
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
        return array (  132 => 42,  127 => 40,  118 => 34,  114 => 33,  110 => 32,  107 => 31,  105 => 30,  101 => 29,  97 => 28,  93 => 27,  89 => 26,  85 => 25,  82 => 24,  80 => 23,  76 => 22,  72 => 21,  67 => 19,  63 => 18,  59 => 17,  55 => 16,  50 => 15,  48 => 14,  46 => 13,  44 => 12,  41 => 10,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/comment.configuring.html.twig", "/opt/drupal/web/core/modules/comment/help_topics/comment.configuring.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 9, "trans" => 10);
        static $filters = array("escape" => 16);
        static $functions = array("render_var" => 12, "help_route_link" => 12, "help_topic_link" => 13);

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
