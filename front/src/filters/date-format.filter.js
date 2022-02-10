import dayjs from 'dayjs';
export function dateFormat(date){
  if (!date){
    return "Date inconnue";
  }
  return dayjs(date).format('DD/MM/YYYY à HH:mm')
}
