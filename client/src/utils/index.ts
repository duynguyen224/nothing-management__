import { IInitialState } from '../context/interface';

// Initial state for reducer
export const initialState: IInitialState = {
    currentUser: null,
    loading: false
};

// Get access token from localStorage
export const getAccessToken = (): string => {
    const userJson: string | null | undefined = localStorage.getItem('currentUser');
    const userObj: any = userJson !== null && userJson.length !== 0 ? JSON.parse(userJson) : '';
    const token: string = userObj.access_token;

    return token;
};

// Read localStorage and define the initialState
export const getInitialState = (): IInitialState => {
    const userJson = localStorage.getItem('currentUser');
    let appState = initialState;

    if (userJson !== null && userJson.length !== 0) {
        const user = JSON.parse(userJson);

        appState = {
            currentUser: {
                access_token: user.access_token,
                type: process.env.REACT_APP_AUTHORIZATION_TYPE ? process.env.REACT_APP_AUTHORIZATION_TYPE : 'Bearer',
                id: user.id,
                name: user.name,
                email: user.email,
                role: user.role
            },
            loading: false
        };
    }

    return appState;
};
