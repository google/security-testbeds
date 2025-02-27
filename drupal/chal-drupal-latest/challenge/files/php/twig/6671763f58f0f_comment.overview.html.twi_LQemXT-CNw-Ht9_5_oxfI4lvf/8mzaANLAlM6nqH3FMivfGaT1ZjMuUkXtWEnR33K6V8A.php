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

/* @help_topics/comment.overview.html.twig */
class __TwigTemplate_0fb3a9abe061aab7940e514ccf36baab extends Template
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
        // line 13
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 14
        $context["users_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("user.overview"));
        // line 15
        echo "<h2>";
        echo t("What is a comment?", array());
        echo "</h2>
<p>";
        // line 16
        echo t("A comment is a piece of content, typically posted by a website visitor, which provides discussion or commentary on other content like blog posts and news articles. Comments are a type of content entity, and can have fields that store text, HTML markup, and other data. Comments are attached to other content entities via Comment fields. See @content_structure_topic for more about content entities and fields.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 17
        echo t("What is a comment type?", array());
        echo "</h2>
<p>";
        // line 18
        echo t("Comments are divided into <em>comment types</em>, which are the entity sub-types for the comment entity type. Each comment type has its own fields and its own form and display settings; each type can be used to comment on a single entity type. You can set up different comment types for different commenting purposes on your web site; for example, you might set up a comment type for recipes that has fields \"How did it taste?\" and \"Did the instructions work?\", and another comment type for blog entries that has only a generic comment body field.", array());
        echo "</p>
<h2>";
        // line 19
        echo t("What is moderation?", array());
        echo "</h2>
<p>";
        // line 20
        echo t("<em>Moderation</em> is a workflow where comments posted by some users on your site are verified before being published, to prevent spam and other bad behavior. The core software provides basic moderation functionality: you can configure permissions so that new comments posted by some user roles start as unpublished until a user with a different role reviews and publishes them. Contributed modules provide additional moderation and spam-reduction functionality, such as requiring untrusted users pass a CAPTCHA test before submitting comments and letting community members flag comments as possible spam. See @users_overview_topic for more about users, permissions, and roles.", array("@users_overview_topic" => ($context["users_overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 21
        echo t("Overview of managing comments", array());
        echo "</h2>
<p>";
        // line 22
        echo t("The core Comment module provides the following functionality:", array());
        echo "</p>
<ul>
  <li>";
        // line 24
        echo t("Posting comments", array());
        echo "</li>
  <li>";
        // line 25
        echo t("Creating comment types; the core Field UI module allows you to attach fields to comment types and attach comment reference fields to other entities so that people can comment on them.", array());
        echo "</li>
  <li>";
        // line 26
        echo t("Configuring commenting", array());
        echo "</li>
  <li>";
        // line 27
        echo t("Moderating comments as discussed above", array());
        echo "</li>
</ul>
<p>";
        // line 29
        echo t("See the related topics listed below for specific tasks.", array());
        echo "</p>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/comment.overview.html.twig";
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
        return array (  94 => 29,  89 => 27,  85 => 26,  81 => 25,  77 => 24,  72 => 22,  68 => 21,  64 => 20,  60 => 19,  56 => 18,  52 => 17,  48 => 16,  43 => 15,  41 => 14,  39 => 13,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/comment.overview.html.twig", "/opt/drupal/web/core/modules/comment/help_topics/comment.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 13, "trans" => 15);
        static $filters = array("escape" => 16);
        static $functions = array("render_var" => 13, "help_topic_link" => 13);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link']
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
