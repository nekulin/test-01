<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(?string $category=null, ?string $sort=null): Factory|View|Application
    {
        $query = News::query();

        if ($category && is_numeric($category)) {

            $query->where('category_id', $category);
        }

        // default sort

        $column = 'id';
        $direction = 'desc';

        if ($sort) {

            list($column, $direction) = explode('-', $sort);

            $column = match ($column) {
                'date' => 'created_at',
                default => 'id',
            };

            $direction = $direction==='asc' ? 'asc' : 'desc';
        }

        $query->orderBy($column, $direction);

        return view('news.index', [
            'category' => $category,
            'news' => $query->paginate(),
        ]);
    }

    public function view(string $slug): Factory|View|Application
    {
        $news = News::whereSlug($slug)
            ->firstOrFail();

        return view('news.view', [
            'news' => $news,
        ]);
    }
}
