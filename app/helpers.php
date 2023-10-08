<?php

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

//ejemplo si consumo el api desde una url diferente
function login_user($array)
{
    // : LOGUEAR CREDENCIAL 
    try {
        //consumo api de login
        $request = Request::create(
            '/api/loginv2',
            'POST',
            $array

        );
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}

function logout_user()
{
    try {
        //consumo api de login
        $request = Request::create(
            '/api/logoutv2',
            'GET'
        );
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}

function albums()
{
    try {
        //consumo api
        $request = Request::create(
            'api/albums',
            'GET'
        );
        //agrego token
        $request->headers->set('Authorization', session('token_web'));
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}

function album($album_id)
{
    try {
        //consumo api 
        $request = Request::create(
            'api/album?id=' . $album_id,
            'GET'
        );
        //agrego token
        $request->headers->set('Authorization', session('token_web'));
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}

function artists()
{
    try {
        //consumo api de login
        $request = Request::create(
            'api/artists',
            'GET'
        );
        //agrego token
        $request->headers->set('Authorization', session('token_web'));
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}

function artist($artist_id)
{
    try {
        //consumo api de login
        $request = Request::create(
            'api/artist?id=' . $artist_id,
            'GET'
        );
        //agrego token
        $request->headers->set('Authorization', session('token_web'));
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}
function generarToken()
{
    try {
        //consumo api de login
        $request = Request::create(
            'api/generarToken',
            'GET'
        );
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}

function songs()
{
    try {
        //consumo api de login
        $request = Request::create(
            'api/songs',
            'GET'
        );
        //agrego token
        $request->headers->set('Authorization', session('token_web'));
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}
function search_songs($descripcion)
{
    try {
        //consumo api de login
        $request = Request::create(
            'api/song?descipcion=' . $descripcion,
            'GET'
        );
        //agrego token
        $request->headers->set('Authorization', session('token_web'));
        //optengo la respuesta
        $response = app()->handle($request);
        $content = json_decode($response->getContent(), true);
        return  $content;
    } catch (RequestException $e) {
        return  $e->getResponse()->getBody()->getContents();
    }
}
