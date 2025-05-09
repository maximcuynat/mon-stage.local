<?php
// src/View/ViewRenderer.php
namespace App\View;

class ViewRenderer
{
    private TemplateResolver $resolver;
    
    public function __construct(TemplateResolver $resolver = null)
    {
        $this->resolver = $resolver ?? new TemplateResolver();
    }
    
    public function render(string $view, array $data = [], string $layout = 'layouts.default'): void
    {
        extract($data);
        ob_start();
        require $this->resolver->resolve($view);
        $content = ob_get_clean();
        if ($layout === null || $layout === false) {
            echo $content;
            return;
        }
        require $this->resolver->resolve($layout);
    }
    
    public function include(string $partial, array $data = []): void
    {
        extract($data);
        require $this->resolver->resolve('partials.' . $partial);
    }
}