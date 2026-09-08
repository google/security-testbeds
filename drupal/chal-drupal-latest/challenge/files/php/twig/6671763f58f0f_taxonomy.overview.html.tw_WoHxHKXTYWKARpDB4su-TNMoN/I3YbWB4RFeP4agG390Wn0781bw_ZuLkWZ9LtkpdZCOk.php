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

/* @help_topics/taxonomy.overview.html.twig */
class __TwigTemplate_36ee180b6b2adb3761a03827961fd166 extends Template
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
        // line 5
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 6
        echo "<h2>";
        echo t("What is taxonomy?", array());
        echo "</h2>
<p>";
        // line 7
        echo t("<em>Taxonomy</em> is used to classify website content. One common example of taxonomy is the tags used to classify or categorize posts in a blog website; a cooking website could use an ingredients taxonomy to classify recipes. Individual taxonomy items are known as <em>terms</em> (the blog tags or recipe ingredients in these examples); and a set of terms is known as a <em>vocabulary</em> (the set of all blog post tags, or the set of all recipe ingredients in these examples). Technically, taxonomy terms are an entity type and the entity subtypes are the vocabularies; see @content_structure_topic for more on content entities. Like other entities, taxonomy terms can have fields attached; for instance, you could set up an image field to contain an icon for each term.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</p>
<p>";
        // line 8
        echo t("An individual vocabulary can organize its terms in a hierarchy, or it could be flat. For example, blog tags normally have a flat structure, while a recipe ingredients vocabulary could be hierarchical (for example, tomatoes could be a sub-term of vegetables, and under tomatoes, you could have green and red tomatoes).", array());
        echo "</p>
<p>";
        // line 9
        echo t("Taxonomy terms are normally attached as reference fields to other content entities, which is how you can use them to classify content. When you set up a taxonomy reference field, you can let users enter terms in two ways:", array());
        echo "</p>
<dl>
  <dt>";
        // line 11
        echo t("Free tagging", array());
        echo "</dt>
  <dd>";
        // line 12
        echo t("New terms can be created right on the content editing form.", array());
        echo "</dd>
  <dt>";
        // line 13
        echo t("Fixed list of terms", array());
        echo "</dt>
  <dd>";
        // line 14
        echo t("The list of terms is curated and managed outside the content editing form, and users can only select from the existing list when editing content.", array());
        echo "</dd>
</dl>
<p>";
        // line 16
        echo t("Taxonomy reference fields can be added to any entity, such as user accounts, content blocks, or regular content items. If you use them to classify regular content items, your site will automatically be set up with taxonomy listing pages for each term; each of these pages lists all of the content items that are classified with that term.", array());
        echo "</p>
<h2>";
        // line 17
        echo t("Overview of managing taxonomy", array());
        echo "</h2>
<p>";
        // line 18
        echo t("The core Taxonomy module allows you to create and edit taxonomy vocabularies and taxonomy terms. The core Field UI module provides a user interface for adding fields to entities, including the taxonomy reference field, and configuring field editing and display. See the related topics listed below for specific tasks.", array());
        echo "</p>
<h2>";
        // line 19
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/structure-taxonomy.html\">";
        // line 21
        echo t("Concept: Taxonomy (Drupal User Guide)", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/taxonomy.overview.html.twig";
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
        return array (  93 => 21,  88 => 19,  84 => 18,  80 => 17,  76 => 16,  71 => 14,  67 => 13,  63 => 12,  59 => 11,  54 => 9,  50 => 8,  46 => 7,  41 => 6,  39 => 5,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/taxonomy.overview.html.twig", "/opt/drupal/web/core/modules/taxonomy/help_topics/taxonomy.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 5, "trans" => 6);
        static $filters = array("escape" => 7);
        static $functions = array("render_var" => 5, "help_topic_link" => 5);

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
