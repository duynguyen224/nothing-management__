import React, { createContext, useReducer } from 'react';
import { getInitialState } from '../utils';
import { Props } from './interface';
import { reducer } from './reducer';

export const AppContext = createContext<any>(null);

function AppContextProvider({ children }: Props): React.ReactElement {
    const [state, dispatch] = useReducer(reducer, getInitialState());
    console.log(11111)
    return (
        <AppContext.Provider
            value={{
                state: state,
                dispatch: dispatch
            }}
        >
            {children}
        </AppContext.Provider>
    );
}

export default AppContextProvider;
