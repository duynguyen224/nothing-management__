export interface IUserInfo {
    access_token: string;
    type: string;
    id: number;
    name: string;
    email: string;
    role: string;
}

export interface Props {
    children: JSX.Element;
}

export interface IInitialState {
    currentUser: IUserInfo | null;
    loading: boolean;
}
