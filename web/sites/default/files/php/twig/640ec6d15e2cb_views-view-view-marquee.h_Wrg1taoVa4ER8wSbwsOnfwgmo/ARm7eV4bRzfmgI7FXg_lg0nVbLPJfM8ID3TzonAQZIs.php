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

/* modules/contrib/view_marquee/templates/views-view-view-marquee.html.twig */
class __TwigTemplate_aa60c8a9a131a5294d7218a23639cde5adc80dc8f80ac982677cb0f3217d8ed7 extends \Twig\Template
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
        // line 17
        $context["classes"] = [0 => "views-view-marquee", 1 => ("marquee-direction-" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 19
($context["options"] ?? null), "direction", [], "any", false, false, true, 19), 19, $this->source))];
        // line 22
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("view_marquee/marquee-style"), "html", null, true);
        echo "
<div";
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 23), 23, $this->source), "html", null, true);
        echo ">
  <marquee ";
        // line 24
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["direction"] ?? null), 24, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["behavior"] ?? null), 24, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["speed"] ?? null), 24, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["delay"] ?? null), 24, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mouseover"] ?? null), 24, $this->source), "html", null, true);
        echo ">
    ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 26
            echo "      <div ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["row_class"] ?? null), 26, $this->source), "html", null, true);
            echo ">
      ";
            // line 27
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["row"], 27, $this->source), "html", null, true);
            echo "
      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "  </marquee>
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/view_marquee/templates/views-view-view-marquee.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 30,  71 => 27,  66 => 26,  62 => 25,  50 => 24,  46 => 23,  42 => 22,  40 => 19,  39 => 17,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * Default theme implementation for Views to output a TARDIS archive.
 *
 * Available variables:
 * - options: View plugin style options:
 *   - row_class: Row classes.
 *   - direction: Marquee direction
 *   - behavior: Marquee direction behavior
 *   - speed: Marquee speed
 *   - delay: Marquee delay
 * @see template_preprocess_views_view_view_marquee()
 *
 */
#}
{%
  set classes = [
    'views-view-marquee',
    'marquee-direction-'~options.direction
  ]
%}
{{ attach_library('view_marquee/marquee-style') }}
<div{{ attributes.addClass(classes) }}>
  <marquee {{ direction }} {{ behavior }} {{ speed }} {{ delay }} {{ mouseover }}>
    {% for row in rows %}
      <div {{ row_class}}>
      {{ row }}
      </div>
    {% endfor %}
  </marquee>
</div>
", "modules/contrib/view_marquee/templates/views-view-view-marquee.html.twig", "/app/web/modules/contrib/view_marquee/templates/views-view-view-marquee.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 17, "for" => 25);
        static $filters = array("escape" => 22);
        static $functions = array("attach_library" => 22);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for'],
                ['escape'],
                ['attach_library']
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
