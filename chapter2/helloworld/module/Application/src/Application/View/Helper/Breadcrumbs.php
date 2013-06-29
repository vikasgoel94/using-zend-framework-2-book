<?php

namespace Application\View\Helper;

/**
 * This view helper class displays breadcrumbs.
 * 
 */
class Breadcrumbs {
 
    /**
     * Menu items.
     * @var array 
     */
    protected $items;
    
    /**
     * Constructor.
     * @param array $config Options.
     */
    public function __construct($config) {
        
        if(isset($config['items'])) {
            $this->items = $config['items'];
        } else {
            throw new \Exception('No items specified');
        }
        
    }
    
    /**
     * Returns HTML code of the breadcrumbs.
     * @return string
     */
    public function __toString() {
        return $this->render();
    }
    
    /**
     * Renders the breadcrumbs.
     * @return string HTML code of the breadcrumbs.
     */
    public function render() {
            
        // Resulting HTML code will be stored in this var
        $result = '<ul class="breadcrumb">';
        
        // Get item count
        $itemCount = count($this->items); 
        
        $itemNum = 1; // item counter
        
        // Walk through items
        foreach($this->items as $label=>$link) {
            
            // Make the last item inactive
            $isActive = ($itemNum==$itemCount?true:false);
            
            // Render current item
            $result .= $this->renderItem($label, $link, $isActive);
                        
            // Increment item counter
            $itemNum++;
        }
        
        $result .= '</ul>';
        
        return $result;
        
    }
    
    /**
     * Renders an item.
     * @param string $label
     * @param string $link
     * @param boolean $isActive
     * @return string HTML code of the item.
     */
    protected function renderItem($label, $link, $isActive) {
        
        $result = $isActive?'<li class="active">':'<li>';
        
        if(!$isActive)
            $result .= '<a href="'.$link.'">'.$label.'</a>';
        else
            $result .= $label;
        
        // Render divider
        if(!$isActive)
           $result .= '<span class="divider">/</span>';
            
        $result .= '</li>';
    
        return $result;
    }
    
    
}