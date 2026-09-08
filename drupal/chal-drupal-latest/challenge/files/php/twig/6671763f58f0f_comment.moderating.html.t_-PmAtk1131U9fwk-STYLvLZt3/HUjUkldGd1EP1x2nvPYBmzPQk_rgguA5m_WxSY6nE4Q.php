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

/* @help_topics/comment.moderating.html.twig */
class __TwigTemplate_43d5bdf1ace7a020a16f227755b61d7a extends Template
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
        // line 9
        echo "  ";
        echo t("Unapproved comments", array());
        $context["comment_unpublished_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 11
        $context["comment_unpublished_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["comment_unpublished_link_text"] ?? null), 11, $this->source), "comment.admin_approval"));
        // line 12
        ob_start(function () { return ''; });
        // line 13
        echo "  ";
        echo t("Comments", array());
        $context["comment_published_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 15
        $context["comment_published_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["comment_published_link_text"] ?? null), 15, $this->source), "comment.admin"));
        // line 16
        ob_start(function () { return ''; });
        // line 17
        echo "  ";
        echo t("Administer comments and comment settings", array());
        $context["comment_permissions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 19
        $context["comment_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["comment_permissions_link_text"] ?? null), 19, $this->source), "user.admin_permissions.module", ["modules" => "comment"]));
        // line 20
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 21
        echo t("Decide which comments are shown on the website.", array());
        echo "</p>
<h2>";
        // line 22
        echo t("Who can moderate comments?", array());
        echo "</h2>
<p>";
        // line 23
        echo t("Users with the <em>@comment_permissions_link</em> permission (typically administrators) can moderate comments. You will also need the <em>Access the Content Overview page</em> permission from the Node module (if it is installed) to navigate to the comment management page.", array("@comment_permissions_link" => ($context["comment_permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 24
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 26
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Content</em> &gt; <em>@comment_published_link</em>. A list of all comments is shown.", array("@comment_published_link" => ($context["comment_published_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 27
        echo t("To unpublish comments, select one or more comments by checking the boxes on the left side (right side in right-to-left languages). Then select <em>Unpublish comment</em> from the <em>Action</em> select list and click <em>Apply to selected items</em>. If you select the <em>Delete comment</em> action, you can instead delete the unwanted  comments.", array());
        echo "</li>
  <li>";
        // line 28
        echo t("To change the content of a comment click <em>Edit</em> from the dropdown button for a particular comment.", array());
        echo "</li>
  <li>";
        // line 29
        echo t("To publish comments that are not yet visible on the website, navigate to the <em>@comment_unpublished_link</em> tab. Select one or more comments by checking the boxes on the left side (right side in right-to-left languages). Then select <em>Publish comment</em> from the <em>Action</em> select list and click <em>Apply to selected items</em>.", array("@comment_unpublished_link" => ($context["comment_unpublished_link"] ?? null), ));
        echo "</li>
</ol>
<h2>";
        // line 31
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/8/core/modules/comment/administering-and-approving-comments\">";
        // line 33
        echo t("Online documentation for moderating comments", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/comment.moderating.html.twig";
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
        return array (  107 => 33,  102 => 31,  97 => 29,  93 => 28,  89 => 27,  85 => 26,  80 => 24,  76 => 23,  72 => 22,  68 => 21,  63 => 20,  61 => 19,  57 => 17,  55 => 16,  53 => 15,  49 => 13,  47 => 12,  45 => 11,  41 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/comment.moderating.html.twig", "/opt/drupal/web/core/modules/comment/help_topics/comment.moderating.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 9);
        static $filters = array("escape" => 23);
        static $functions = array("render_var" => 11, "help_route_link" => 11);

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
