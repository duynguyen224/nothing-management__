export interface IConfig {
    basename: string;
    defaultPath: string;
    fontFamily: string;
    borderRadius: number;
}

const config: IConfig = {
    // basename: only at build time to set, and Don't add '/' at end off BASENAME for breadcrumbs, also Don't put only '/' use blank('') instead,
    // like '/berry-material-react/react/default'
    // basename: '/admin',
    // defaultPath: '/dashboard',
    basename: '/',
    defaultPath: '/',
    fontFamily: `'Roboto', sans-serif`,
    borderRadius: 12
};

export default config;
