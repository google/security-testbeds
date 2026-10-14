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

/* @help_topics/announcements_feed.overview.html.twig */
class __TwigTemplate_2a554be3aa7cfdb18009fe77770a5dee extends Template
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
        ob_start(function () { return ''; });
        // line 6
        echo t("Announcements", array());
        $context["actions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["actions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["actions_link_text"] ?? null), 8, $this->source), "announcements_feed.announcement"));
        // line 9
        ob_start(function () { return ''; });
        // line 10
        echo t("View official announcements related to Drupal", array());
        $context["permissions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        $context["permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["permissions_link_text"] ?? null), 12, $this->source), "user.admin_permissions.module", ["modules" => "announcements_feed"]));
        // line 13
        echo "<h2>";
        echo t("What are Drupal announcements?", array());
        echo "</h2>
<p>";
        // line 14
        echo t("A feed of announcements about the Drupal project and Drupal Association programs.", array());
        echo "</p>
<p>";
        // line 15
        echo t("The purpose of this feed is to provide a channel for outreach directly to Drupal site owners. This content must be highly relevant to site owners interests, serve the strategic goals of the project, and/or promote the sustainability of the project and the Drupal Association.", array());
        echo "</p>
<p>";
        // line 16
        echo t("The module sources its content from a JSON feed generated from <a href=\"https://www.drupal.org/about/announcements\">here</a>. The governance policy for the content is documented <a href=\"https://www.drupal.org/node/3274085\">here</a>.", array());
        echo "</p>
<h2>";
        // line 17
        echo t("How can I see the Announcements in my site?", array());
        echo "</h2>
<p>";
        // line 18
        echo t("If you have the toolbar module enabled, you will see a direct link to them in the toolbar. If the toolbar module is not enabled, the content can always be accessed in the <em>@actions_link</em> page.", array("@actions_link" => ($context["actions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 19
        echo t("Who can see the Announcements?", array());
        echo "</h2>
<p>";
        // line 20
        echo t("Users with the <em>@permissions_link</em> permission can view Drupal announcements.", array("@permissions_link" => ($context["permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 21
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/core-modules-and-themes/core-modules/announcements-feed/announcements-feed-module-overview\">";
        // line 23
        echo t("Announcement module overview", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/announcements_feed.overview.html.twig";
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
        return array (  91 => 23,  86 => 21,  82 => 20,  78 => 19,  74 => 18,  70 => 17,  66 => 16,  62 => 15,  58 => 14,  53 => 13,  51 => 12,  48 => 10,  46 => 9,  44 => 8,  41 => 6,  39 => 5,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/announcements_feed.overview.html.twig", "/opt/drupal/web/core/modules/announcements_feed/help_topics/announcements_feed.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 5, "trans" => 6);
        static $filters = array("escape" => 18);
        static $functions = array("render_var" => 8, "help_route_link" => 8);

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
