import DataFormatter from './DataFormatter';
import TimeManipulationService from '../TimeManipulationService';

export default class ParamsFormatter {

    formatQuery(query, params, page) {
        query = {};
        for (let param in params) {
            if (params[param] !== '' && params[param] !== null && params[param].getTime) {
                query[DataFormatter.snakeCaseStr(param)] = moment(params[param]).format('x');
            }
            else if (params[param] !== '' && params[param] !== null) {
                query[DataFormatter.snakeCaseStr(param)] = params[param];
            }
        }
        query.page = page;

        return query;
    }

    clearParams(params, query) {
        for (let param in params) {
            params[param] = '';
            delete query[DataFormatter.snakeCaseStr(param)];
        }
    }

}