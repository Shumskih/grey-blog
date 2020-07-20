<?php
use App\Api\Article;
use App\Api\Category;
use App\Api\Comment;
use App\Api\Pagination;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write(
        '<a href="/api/v1/articles">/api/v1/articles</a>' . '<br>' .
                '<a href="/api/v1/categories">/api/v1/categories</a>' . '<br>' .
                '<a href="/api/v1/categories/1">/api/v1/categories/1</a>' . '<br>' .
                '<a href="/api/v1/top-articles/10">/api/v1/top-articles/10</a>' . '<br>' .
                '<a href="/api/v1/top-articles-by-comments/10">/api/v1/top-articles-by-comments/10</a>' . '<br>' .
                '<a href="/api/v1/article/10/comments">/api/v1/article/10/comments</a>'
    );
    return $response;
});

// /api/v1/articles
$app->get('/articles[/page-{pageNumber}[/{numberArticlesOnPage}]]', function (Request $request, Response $response, $args) {
    $navParams = Pagination::getInstance();

    if (isset($args['pageNumber'])) $navParams->setINumPage($args['pageNumber']);
    if (isset($args['numberArticlesOnPage'])) $navParams->setNPageSize($args['numberArticlesOnPage']);

    $article = new Article();
    $articles = $article->getAll();

    if (!isset($articles)) {
        return $response->withJson(["404" => 'Page not found']);
    }
    return $response->withJson($articles);
});

// /api/v1/categories
$app->get('/categories', function (Request $request, Response $response, $args) {
    $category = new Category();
    $categories = $category->getAll();

    if (!isset($categories)) {
        return $response->withJson(["404" => 'Page not found']);
    }
    unset($category);

    return $response->withJson($categories);
});

// /api/v1/categories/categoryId
$app->get('/categories/{categoryId}[/page-{pageNumber}[/{numberArticlesOnPage}]]', function (Request $request, Response $response, $args) {
    $navParams = Pagination::getInstance();

    if (isset($args['pageNumber'])) $navParams->setINumPage($args['pageNumber']);
    if (isset($args['numberArticlesOnPage'])) $navParams->setNPageSize($args['numberArticlesOnPage']);

    $category = new Category();
    $category = $category->getById($args['categoryId']);

    $article = new Article();
    $articles = $article->getByCategoryId($args['categoryId']);
    $category->setArticles($articles);

    if (!isset($category)) {
        return $response->withJson(["404" => 'Page not found']);
    }
    unset($articles);

    return $response->withJson($category);
});

// /top-articles
$app->get('/top-articles[/{count}]', function (Request $request, Response $response, $args) {
    if ($args['nTopCount'] == NULL) $args['nTopCount'] = 10;

    $article = new Article();
    $articles = $article->getTopArticles($args['nTopCount']);

    if (!isset($articles)) {
        return $response->withJson(["404" => 'Page not found']);
    }
    return $response->withJson($articles);
});

// /top-articles-by-comments
$app->get('/top-articles-by-comments[/{count}]', function (Request $request, Response $response, $args) {
    if ($args['count'] == NULL) $args['count'] = 10;

    $article = new Article();
    $articles = $article->getMostCommented($args['count']);

    if (!isset($articles)) {
        return $response->withJson(["404" => 'Page not found']);
    }
    return $response->withJson($articles);
});

// /article/articleId
$app->get('/article/{articleId}/comments[/page-{pageNumber}]', function (Request $request, Response $response, $args) {
    $navParams = Pagination::getInstance();

    if (isset($args['pageNumber'])) $navParams->setINumPage($args['pageNumber']);

    $comment = new Comment();
    $comments = $comment->getByArticleId($args['articleId']);

    if (!isset($comments)) {
        return $response->withJson(["404" => 'Page not found']);
    }
    unset($comment);

    return $response->withJson($comments);
});