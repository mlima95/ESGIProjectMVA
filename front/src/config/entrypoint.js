export const BASE_ENTRYPOINT = "http://localhost:8888/"
export const ENTRY_POINT_AUTH = BASE_ENTRYPOINT+"authentication_token"
export const ENTRYPOINT = BASE_ENTRYPOINT + 'api';

/**
 * TODO Norlamement la partie fetch est faite, ya que à posser le token sauf en login
 * Interdit certaine view selon le rôle
 * Note : le fetch est peut être à revoir (new URL..) avec un toString ou équivalent
 */
