export default class TimeManipulationService {

    static isTimestamp(str) {
        return (str.search(/^[0-9]{13}$/) === 0);
    }

    static getDateByTimestamp(timestamp) {
        let date = new Date();
        date.setTime(timestamp);
        return date;
    }
}