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

/* @help_topics/node.editing.html.twig */
class __TwigTemplate_957ceb32adbf2522743b3460730a062b extends Template
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
        echo "  ";
        echo t("Content", array());
        $context["content_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["content_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["content_link_text"] ?? null), 10, $this->source), "system.admin_content"));
        // line 11
        ob_start(function () { return ''; });
        // line 12
        echo "  ";
        echo t("Access the Content overview page", array());
        $context["content_permissions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 14
        $context["content_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["content_permissions_link_text"] ?? null), 14, $this->source), "user.admin_permissions.module", ["modules" => "node"]));
        // line 15
        $context["node_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("node.overview"));
        // line 16
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 17
        echo t("Find a content item and edit it, or update a group of content items in bulk. See @node_overview_topic for more about content types and content items.", array("@node_overview_topic" => ($context["node_overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 18
        echo t("Who can find and edit content?", array());
        echo "</h2>
<p>";
        // line 19
        echo t("Users with the <em>@content_permissions_link</em> permission can use the <em>Content</em> page to find content. Each content type has its own edit permissions. For example, to edit content of type Article, a user would need the <em>Article: Edit own content</em> permission to edit an article they created, or the <em>Article: Edit any content</em> permission to edit an article someone else created. In addition, users with the <em>Bypass content access control</em> or <em>Administer content</em> permission can edit content items of all types. Some contributed modules change the permission structure for editing content.", array("@content_permissions_link" => ($context["content_permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 20
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 22
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>@content_link</em>.", array("@content_link" => ($context["content_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 23
        echo t("Optionally, use filters to reduce the list of content items shown:", array());
        // line 24
        echo "    <ul>
      <li>";
        // line 25
        echo t("<em>Title</em>: key word(s) from the title", array());
        echo "</li>
      <li>";
        // line 26
        echo t("<em>Content type</em>", array());
        echo "</li>
      <li>";
        // line 27
        echo t("<em>Published status</em>", array());
        echo "</li>
      <li>";
        // line 28
        echo t("<em>Language</em>", array());
        echo "</li>
    </ul>
    ";
        // line 30
        echo t("If you enter or select filter values, click <em>Filter</em> to apply the filters.", array());
        echo "</li>
  <li>";
        // line 31
        echo t("Optionally, sort the list by clicking a column header. Click again to reverse the order.", array());
        echo "</li>
  <li>";
        // line 32
        echo t("To edit the title or other field values for one content item, click <em>Edit</em> in the row of the content item. Update the values and click <em>Save</em>.", array());
        echo "</li>
  <li>";
        // line 33
        echo t("A few types of edits can be done in bulk to multiple content items. For example, to publish several unpublished content items, check the boxes in the left column (right column in right-to-left languages) to select the desired content items. For <em>Action</em>, select the <em>Publish content</em> action. Click <em>Apply to selected items</em> to make the change. The other actions under <em>Action</em> work in a similar manner.", array());
        echo "</li>
</ol>
<h2>";
        // line 35
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/content-chapter.html\">";
        // line 37
        echo t("Basic Page Management (Drupal User Guide)", array());
        echo "</a></li>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/content-edit.html\">";
        // line 38
        echo t("Editing a Content Item (Drupal User Guide)", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/node.editing.html.twig";
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
        return array (  131 => 38,  127 => 37,  122 => 35,  117 => 33,  113 => 32,  109 => 31,  105 => 30,  100 => 28,  96 => 27,  92 => 26,  88 => 25,  85 => 24,  83 => 23,  79 => 22,  74 => 20,  70 => 19,  66 => 18,  62 => 17,  57 => 16,  55 => 15,  53 => 14,  49 => 12,  47 => 11,  45 => 10,  41 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/node.editing.html.twig", "/opt/drupal/web/core/modules/node/help_topics/node.editing.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 8);
        static $filters = array("escape" => 17);
        static $functions = array("render_var" => 10, "help_route_link" => 10, "help_topic_link" => 15);

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
