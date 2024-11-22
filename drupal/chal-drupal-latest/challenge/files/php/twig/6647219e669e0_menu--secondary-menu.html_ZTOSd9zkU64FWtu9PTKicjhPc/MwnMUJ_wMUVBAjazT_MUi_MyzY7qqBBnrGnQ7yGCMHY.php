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

/* core/themes/olivero/templates/navigation/menu--secondary-menu.html.twig */
class __TwigTemplate_0c921d50088a183f214d71cc22e413f1 extends Template
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
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("olivero/navigation-secondary"), "html", null, true);
        echo "

";
        // line 25
        $macros["menus"] = $this->macros["menus"] = $this;
        // line 26
        echo "
";
        // line 31
        $context["attributes"] = twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["menu"], "method", false, false, true, 31);
        // line 32
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_call_macro($macros["menus"], "macro_menu_links", [($context["items"] ?? null), ($context["attributes"] ?? null), 0], 32, $context, $this->getSourceContext()));
        echo "

";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["_self", "items", "menu_level"]);    }

    // line 34
    public function macro_menu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 35
            echo "  ";
            $context["secondary_nav_level"] = ("secondary-nav__menu--level-" . (($context["menu_level"] ?? null) + 1));
            // line 36
            echo "  ";
            $macros["menus"] = $this;
            // line 37
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 38
                echo "    <ul";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["secondary-nav__menu", ($context["secondary_nav_level"] ?? null)], "method", false, false, true, 38), 38, $this->source), "html", null, true);
                echo ">
      ";
                // line 39
                $context["attributes"] = twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "removeClass", [($context["secondary_nav_level"] ?? null)], "method", false, false, true, 39);
                // line 40
                echo "      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 41
                    echo "
        ";
                    // line 42
                    if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 42), "isRouted", [], "any", false, false, true, 42) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 42), "routeName", [], "any", false, false, true, 42) == "<nolink>"))) {
                        // line 43
                        echo "          ";
                        $context["menu_item_type"] = "nolink";
                        // line 44
                        echo "        ";
                    } elseif ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 44), "isRouted", [], "any", false, false, true, 44) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 44), "routeName", [], "any", false, false, true, 44) == "<button>"))) {
                        // line 45
                        echo "          ";
                        $context["menu_item_type"] = "button";
                        // line 46
                        echo "        ";
                    } else {
                        // line 47
                        echo "          ";
                        $context["menu_item_type"] = "link";
                        // line 48
                        echo "        ";
                    }
                    // line 49
                    echo "
        ";
                    // line 50
                    $context["item_classes"] = ["secondary-nav__menu-item", ("secondary-nav__menu-item--" . $this->sandbox->ensureToStringAllowed(                    // line 52
($context["menu_item_type"] ?? null), 52, $this->source)), ("secondary-nav__menu-item--level-" . (                    // line 53
($context["menu_level"] ?? null) + 1)), ((twig_get_attribute($this->env, $this->source,                     // line 54
$context["item"], "in_active_trail", [], "any", false, false, true, 54)) ? ("secondary-nav__menu-item--active-trail") : ("")), ((twig_get_attribute($this->env, $this->source,                     // line 55
$context["item"], "below", [], "any", false, false, true, 55)) ? ("secondary-nav__menu-item--has-children") : (""))];
                    // line 58
                    echo "
        ";
                    // line 59
                    $context["link_classes"] = ["secondary-nav__menu-link", ("secondary-nav__menu-link--" . $this->sandbox->ensureToStringAllowed(                    // line 61
($context["menu_item_type"] ?? null), 61, $this->source)), ("secondary-nav__menu-link--level-" . (                    // line 62
($context["menu_level"] ?? null) + 1)), ((twig_get_attribute($this->env, $this->source,                     // line 63
$context["item"], "in_active_trail", [], "any", false, false, true, 63)) ? ("secondary-nav__menu-link--active-trail") : ("")), ((twig_get_attribute($this->env, $this->source,                     // line 64
$context["item"], "below", [], "any", false, false, true, 64)) ? ("secondary-nav__menu-link--has-children") : (""))];
                    // line 67
                    echo "
        <li";
                    // line 68
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "attributes", [], "any", false, false, true, 68), "addClass", [($context["item_classes"] ?? null)], "method", false, false, true, 68), 68, $this->source), "html", null, true);
                    echo ">
          ";
                    // line 69
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 69), 69, $this->source), $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 69), 69, $this->source), ["class" => ($context["link_classes"] ?? null)]), "html", null, true);
                    echo "

          ";
                    // line 71
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 71)) {
                        // line 72
                        echo "            ";
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_call_macro($macros["menus"], "macro_menu_links", [twig_get_attribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 72), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1)], 72, $context, $this->getSourceContext()));
                        echo "
          ";
                    }
                    // line 74
                    echo "        </li>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 76
                echo "    </ul>
  ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "core/themes/olivero/templates/navigation/menu--secondary-menu.html.twig";
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
        return array (  163 => 76,  156 => 74,  150 => 72,  148 => 71,  143 => 69,  139 => 68,  136 => 67,  134 => 64,  133 => 63,  132 => 62,  131 => 61,  130 => 59,  127 => 58,  125 => 55,  124 => 54,  123 => 53,  122 => 52,  121 => 50,  118 => 49,  115 => 48,  112 => 47,  109 => 46,  106 => 45,  103 => 44,  100 => 43,  98 => 42,  95 => 41,  90 => 40,  88 => 39,  83 => 38,  80 => 37,  77 => 36,  74 => 35,  59 => 34,  51 => 32,  49 => 31,  46 => 26,  44 => 25,  39 => 23,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/olivero/templates/navigation/menu--secondary-menu.html.twig", "/opt/drupal/web/core/themes/olivero/templates/navigation/menu--secondary-menu.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("import" => 25, "set" => 31, "macro" => 34, "if" => 37, "for" => 40);
        static $filters = array("escape" => 23);
        static $functions = array("attach_library" => 23, "link" => 69);

        try {
            $this->sandbox->checkSecurity(
                ['import', 'set', 'macro', 'if', 'for'],
                ['escape'],
                ['attach_library', 'link']
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
