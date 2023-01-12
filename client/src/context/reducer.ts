export const LOGIN_REQUEST = 'LOGIN_REQUEST';
export const LOGIN_SUCCESS = 'LOGIN_SUCCESS';
export const LOGIN_FAILED = 'LOGIN_FAILED';
export const LOGOUT = 'LOGOUT';

export function reducer(state: any, action: any) {
    switch (action.type) {
        case LOGIN_REQUEST:
            return {
                ...state,
                loading: true
            };
        case LOGIN_SUCCESS:
            const user = action.payload;
            return {
                ...state,
                currentUser: user,
                loading: false
            };
        case LOGIN_FAILED:
            return {
                ...state,
                currentUser: null,
                loading: false
            };
        case LOGOUT:
            return {
                ...state,
                currentUser: null,
                loading: false
            };
        default:
            throw new Error(`Unhandled action type !`);
    }
}
