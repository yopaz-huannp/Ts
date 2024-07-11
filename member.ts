export interface MemberInterface {
    id?: number;
    interview: InterviewInterface;
    user: UserMemberInterface;
    working_profile: WorkingProfileInterface;
    bank_account?: BankAccountInterface;
    errors: {
        start_date: string | null;
        participants: string | null;
        hour: string | null;
        environment: string | null;
        zoom: string | null;
        skill: string | null;
        feel: string | null;
        reason: string | null;
        current_job: string | null;
        note: string | null;
        call: string | null;

        first_name: string | null;
        last_name: string | null;
        first_name_kana: string | null;
        last_name_kana: string | null;
        gender: string | null;
        date_of_birth: string | null;
        phone_number: string | null;
        email: string | null;
        postal_code: string | null;
        prefecture_id: string | null;
        district: string | null;
        address: string | null;
    };
}

export interface InterviewInterface {
    id?: number;
    start_date: string;
    participants: string;
    hour: string;
    environment: string;
    zoom: string;
    skill: string;
    feel: string;
    reason: string;
    current_job: string;
    note: string;
    call: string;
}

export interface UserMemberInterface {
    id?: number;
    first_name: string;
    last_name: string;
    first_name_kana: string;
    last_name_kana: string;
    gender: string;
    date_of_birth: string;
    phone_number: string;
    email: string;
    postal_code: string;
    prefecture_id: string;
    prefecture_name ?: string;
    district: string;
    address: string;
    status: number;
    uid?: string;
}
export interface OptionMemberInterface {
    icons: string;
    genders: Array<{
        value: string;
        name: string;
    }>;
    persons: Array<{
        value: string;
        name: string;
    }>;
    traffics: Array<{
        value: string;
        name: string;
    }>;
    account_types: Array<{
        value: string;
        name: string;
    }>;
    days: Array<{
        value: string;
        name: string;
    }>;
    sessions: Array<{
        value: string;
        name: string;
    }>;
    status: { [key: string]: Array<{ value: string; name: string }> };
}
export interface WorkingProfileInterface {
    id?: number;
    member_type: string;
    affiliated_university: string;
    affiliated_faculty: string;
    transportation: string;
    range_minutes: string;
    nearest_station: string;
    range_stations: string;
    acceptable_requests :Array <{
        content : string
    }>;
    unacceptable_requests:Array <{
        content : string
    }>;
    unit_price: string;
    available_times: { [key: string]: string };
}
export interface BankAccountInterface {
    bank_name: string;
    branch_name: string;
    account_type: string;
    account_number: string;
}
export interface MemberPaginateInterface {
    active: boolean;
    label: string;
    url: string;
}
