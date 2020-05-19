<?php 

function menus() {
    return App\Category::where('parent_id', null)
            ->with('children')
            ->get();
}