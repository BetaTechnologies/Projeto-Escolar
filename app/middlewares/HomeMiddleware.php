<?php

    namespace app\middlewares;

    class HomeMiddleware
    {

        public function __invoke($request, $response, $next)
        {

            if (!isset($_SESSION['login'])) {
                header("Location: /");
                die();
            }

            $response = $next($request, $response);

            return $response;
        }
    }