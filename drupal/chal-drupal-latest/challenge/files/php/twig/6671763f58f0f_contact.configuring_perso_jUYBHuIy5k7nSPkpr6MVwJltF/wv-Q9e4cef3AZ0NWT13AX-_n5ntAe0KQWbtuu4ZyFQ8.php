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

/* @help_topics/contact.configuring_personal.html.twig */
class __TwigTemplate_75ada19bf694dbca9a913192b56c4f1b extends Template
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
        echo t("Account settings", array());
        $context["config_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["config_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["config_link_text"] ?? null), 8, $this->source), "entity.user.admin_form"));
        // line 9
        ob_start(function () { return ''; });
        echo t("Permissions", array());
        $context["permission_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["permission_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["permission_link_text"] ?? null), 10, $this->source), "user.admin_permissions"));
        // line 11
        $context["adding_fields_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("contact.adding_fields"));
        // line 12
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 13
        echo t("Configure personal contact forms for registered users on the website.", array());
        echo "</p>
<h2>";
        // line 14
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 16
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>People</em> &gt; <em>@config_link</em>.", array("@config_link" => ($context["config_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 17
        echo t("In the <em>Contact settings</em> section, check/uncheck the box to enable/disable the contact form for new user accounts.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("Click <em>Save configuration</em>.", array());
        echo "</li>
  <li>";
        // line 19
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>People</em> &gt; <em>@permission_link</em>.", array("@permission_link" => ($context["permission_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 20
        echo t("Verify that permissions are correct for your site's roles, including the generic <em>Anonymous user</em> and <em>Authenticated user</em>. In order to use personal contact forms, users need both <em>View user information</em> (in the <em>User</em> section, which enables them to view user profiles) and <em>Use users' personal contact forms</em> (in the <em>Contact</em> section, which enables them to use contact forms if they can view user profiles).", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Click <em>Save permissions</em>.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("The contact form will always have <em>Subject</em> and <em>Message</em> fields. If you want to add more fields, follow the steps in @adding_fields_topic.", array("@adding_fields_topic" => ($context["adding_fields_topic"] ?? null), ));
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/contact.configuring_personal.html.twig";
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
        return array (  91 => 22,  87 => 21,  83 => 20,  79 => 19,  75 => 18,  71 => 17,  67 => 16,  62 => 14,  58 => 13,  53 => 12,  51 => 11,  49 => 10,  45 => 9,  43 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/contact.configuring_personal.html.twig", "/opt/drupal/web/core/modules/contact/help_topics/contact.configuring_personal.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 16);
        static $functions = array("render_var" => 8, "help_route_link" => 8, "help_topic_link" => 11);

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
