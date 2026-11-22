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

/* @help_topics/image.style.html.twig */
class __TwigTemplate_b3596f5e45efd8b876f681bf3b37f8a3 extends Template
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
        $context["media_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.media"));
        // line 9
        ob_start(function () { return ''; });
        echo t("Image styles", array());
        $context["styles_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["styles_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["styles_text"] ?? null), 10, $this->source), "entity.image_style.collection"));
        // line 11
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 12
        echo t("Add a new image style, which can be used to process and display images. See @media_topic for an overview of image styles.", array("@media_topic" => ($context["media_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 13
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 15
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Media</em> &gt; @styles_link.", array("@styles_link" => ($context["styles_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 16
        echo t("Click <em>Add image style</em>.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("Enter a descriptive <em>Image style name</em>, and click <em>Create new style</em>.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("Under <em>Effect</em>, choose an effect to apply and click <em>Add</em>.", array());
        echo "</li>
  <li>";
        // line 19
        echo t("Configure the effect on the next page. Most effects require some additional configuration after they are added.  For example, for the <em>Crop</em> effect, enter the <em>Width</em> and <em>Height</em> to crop the image to, and choose the <em>Anchor</em> point. Click <em>Add effect</em>.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("Repeat the previous two steps until all of the effects have been added.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Drag to change the order of the effects. Then click <em>Save</em> to save the new order.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("The image style can now be used to format a field containing an image in your layouts or traditional field displays. It can also be used as part of a responsive image style. See related topics below for more information.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/image.style.html.twig";
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
        return array (  89 => 22,  85 => 21,  81 => 20,  77 => 19,  73 => 18,  69 => 17,  65 => 16,  61 => 15,  56 => 13,  52 => 12,  47 => 11,  45 => 10,  41 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/image.style.html.twig", "/opt/drupal/web/core/modules/image/help_topics/image.style.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 9);
        static $filters = array("escape" => 12);
        static $functions = array("render_var" => 8, "help_topic_link" => 8, "help_route_link" => 10);

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
