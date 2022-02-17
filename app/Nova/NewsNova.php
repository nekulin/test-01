<?php

namespace App\Nova;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;

/**
 * @mixin News
 */
class NewsNova extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = News::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
    ];

    public static function label()
    {
        return 'Новости';
    }

    public static function singularLabel()
    {
        return 'Новость';
    }

    public static function createButtonLabel()
    {
        return 'Добавить новость';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Категория', 'category', CategoryNova::class)
                ->showCreateRelationButton()
                ->required()
                ->rules('required'),

            Text::make('Название', 'name')
                ->required()
                ->rules(
                    'required',
                    'string', 'max:255', 'min:1',
                ),

            Slug::make('Индентификатор', 'slug')
                ->from('name')
                ->required()
                ->rules(
                    'required',
                    'string', 'max:255', 'min:1',
                    Rule::unique(News::class, 'slug')
                        ->ignore($this->model()->getKey()),
                )
                ->onlyOnForms()->showOnDetail(),

            Trix::make('Краткое описание', 'short')
                ->required()
                ->rules('required')
                ->onlyOnForms()->showOnDetail(),

            Trix::make('Полное описание', 'full')
                ->required()
                ->rules('required')
                ->onlyOnForms()->showOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
