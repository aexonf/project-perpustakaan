import React from "react";

export default function SearchBar() {
    const url = new URL(window.location.href);
    const param = url.searchParams.get("title");
    return (
        <section className="-mt-[30px] w-full" id="header">
            <div className="flex justify-center w-full">
                <form
                    className="relative max-w-[740px] w-full h-full"
                    action="/"
                    method="get"
                >
                    <input
                        className="block w-full text-gray-900 placeholder:text-[#b8b8b8] border-none rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none p-5 text-2xl shadow-md"
                        name="title"
                        defaultValue={param}
                        placeholder="Masukkan kata kunci untuk mencari koleksi..."
                    />
                    <div className="absolute inset-y-0 end-0 flex items-center pe-5 pointer-events-none">
                        <svg
                            className="w-[16px] h-[16px] text-gray-500"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 20"
                        >
                            <path
                                stroke="currentColor"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                            />
                        </svg>
                    </div>
                </form>
            </div>
        </section>
    );
}
