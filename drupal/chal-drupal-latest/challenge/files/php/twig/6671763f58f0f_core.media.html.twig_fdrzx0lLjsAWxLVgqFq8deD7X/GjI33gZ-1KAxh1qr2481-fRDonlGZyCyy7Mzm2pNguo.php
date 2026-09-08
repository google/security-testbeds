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

/* @help_topics/core.media.html.twig */
class __TwigTemplate_d9f54124adc16889c05968d777417375 extends Template
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
        // line 11
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 12
        echo "<h2>";
        echo t("What are media items?", array());
        echo "</h2>
<p>";
        // line 13
        echo t("Core media items include audio, images, documents, and videos. You can add other media types, such as social media posts, through the use of contributed modules. Media items may be files located in your site's file system, or remote items referenced by a URL. Media items are content entities, and they are divided into media types (which are entity sub-types); media types can have fields. See @content_structure_topic for more information on content entities and fields.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 14
        echo t("What is the media library?", array());
        echo "</h2>
<p>";
        // line 15
        echo t("The media library is a visual user interface for managing and reusing media items. Add media items to content using Media reference fields and the Media library field widget.", array());
        echo "</p>
<h2>";
        // line 16
        echo t("What is an image style?", array());
        echo "</h2>
<p>";
        // line 17
        echo t("An image style is a set of processing steps, known as <em>effects</em>, that can be applied to images. Examples of effects include scaling and cropping images to different sizes. Responsive image styles can associate image styles with your theme's size breakpoints. This allows serving images sized for the browser width.", array());
        echo "</p>
<h2>";
        // line 18
        echo t("Overview of managing media", array());
        echo "</h2>
<p>";
        // line 19
        echo t("The following modules provide media-related functionality:", array());
        echo "</p>
<ul>
  <li>";
        // line 21
        echo t("Media items and media types are managed by the core Media module.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("The core Media module provides a Media reference field to add media to content entities. The core File and Image modules also provide reference fields. It is recommended to use the Media reference field because it is more versatile.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("The core Media Library module provides the media library and the Media library field widget. With this module installed, the Media library field widget becomes the default widget for editing Media reference fields.", array());
        echo "</li>
  <li>";
        // line 24
        echo t("The core Image module provides a user interface for defining image styles. The core Responsive Image module provides responsive image styles. Using the core Breakpoint module, and a breakpoint-enabled theme, these responsive styles can serve images sized for the browser.", array());
        echo "</li>
</ul>
<p>";
        // line 26
        echo t("See the related topics listed below for specific tasks.", array());
        echo "</p>
<h2>";
        // line 27
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li>";
        // line 29
        echo t("<a href=\"https://www.drupal.org/docs/8/core/modules/media\">Media module</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.media.html.twig";
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
        return array (  101 => 29,  96 => 27,  92 => 26,  87 => 24,  83 => 23,  79 => 22,  75 => 21,  70 => 19,  66 => 18,  62 => 17,  58 => 16,  54 => 15,  50 => 14,  46 => 13,  41 => 12,  39 => 11,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.media.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.media.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 11, "trans" => 12);
        static $filters = array("escape" => 13);
        static $functions = array("render_var" => 11, "help_topic_link" => 11);

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
