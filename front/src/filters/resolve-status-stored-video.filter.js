
export function resolveStatusStoredVideoFilter (status) {
  switch (parseInt(status)) {
    case 0:
       return "En cours"
    case 1:
      return "Terminé"
    default:
      return "Erreur"
  }
}
