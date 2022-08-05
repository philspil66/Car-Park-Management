<?php namespace App\Classes;

use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;
use App\Models\CategoryLangModel;
use Validator;

class Category extends EST {

    /**
     * Returns category name for given category_id
     *
     * @param  $category_id
     * @return String
     */
    public static function getCategoryName( $category_id ) {
 
       $category = CategoryLangModel::where('category_id', '=', $category_id)->get();
       return $category[0]->description;

    }

    /**
     * Returns category type for given category_id
     *
     * @param  $category_id
     * @return String
     */
    public static function getCategoryType( $category_id ) {

        $category = CategoryModel::where('id', '=', $category_id)->get();
        return $category[0]->type;

    }

    /**
     * Returns categories (by type if optional parameter $type is supplied )
     *
     * @param  $type
     * @return Array
     */
    public static function getCategories( $type = null ) {

        $categories = null;

        if( $type ){
            $categories = CategoryModel::where('type', '=', $type)->orderBy('slug')->get();
        }
        else{
            $categories = CategoryModel::orderBy('slug')->get();
        }

        return $categories;

    }

    /**
     * Validates input fields for 'Add / Edit Category' form.
     *
     * @param  Array $input Form Fields
     * @return Validator object
     */
    public static function validateAddEditCategoryInput( $input ) {
        
        //
        // Customise attributes names for display.
        $customAttributes = array(
            'category_description' => 'Description',
            'category_type' => 'Type'
        );
        
        //
        // Define custom messages.
        $messages = array(
            'category_description.string' => 'Category name is not valid',
            'category_description.min' => 'Category name must be at least 2 characters',
            'category_type' => 'Category type is not valid',
        );        
        
        //
        // Set validation rules
        $rules = array(
            'category_description' => 'required|string|min:2|max:255',
            'category_type' => 'required|string'
        );
        
        // Apply validation rules
        return Validator::make($input, $rules, $messages, $customAttributes);

    }

    /**
     * Creates category slug from $description string
     * Converts string to lowercase and replaces spaces with hyphens.
     *
     * @param  String $description
     * @return string
     */
    public static function createCategorySlug( $description ) {
        
        $slug = str_replace(" ", "-", strtolower( $description ));

        return $slug;

    }

}