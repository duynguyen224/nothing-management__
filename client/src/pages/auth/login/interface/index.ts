// For currentUser login and currentUser in localStorage
export interface IUser {
    access_token: string;
    id: number;
    name: string;
    email: string;
    role: string;
}

// For form input login
export interface IFormInput {
    email: string;
    password: string;
}

export interface Props {
    user: IUser;
}
