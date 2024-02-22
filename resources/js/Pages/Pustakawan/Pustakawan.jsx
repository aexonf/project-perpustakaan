import React from "react";
import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import SearchBar from "@/components/SearchBar";
import { Separator } from "@/components/ui/separator";

export default function Pustakawan() {
    return (
        <>
            <Head title="Informasi Pustakawan" />
            <Navbar />
            <main className="w-full px-4">
                <SearchBar />
                <section
                    className="my-10 space-y-5 w-full container"
                    id="content"
                >
                    <h1 className="text-3xl tracking-wide font-semibold">
                        Profil Pustakawan
                    </h1>
                    <Separator />
                    <div className="mx-10 pt-5 grid grid-cols-1 gap-5 sm:grid-cols-1 md:grid-cols-2">
                        <div className="w-full p-4 flex space-x-5">
                            <img
                                className="object-cover w-36 h-auto bg-[#dae1e7] p-4"
                                src="https://perpus.unpam.ac.id/images/persons/user_admin.png"
                                alt=""
                            />
                            <div>
                                <h5 className="flex w-full font-semibold"></h5>
                                Nama : &nbsp; <strong> Lorem</strong>
                                <h5 className="flex w-full font-semibold"></h5>
                                Jabatan : &nbsp; <strong> Lorem</strong>
                                <h5 className="flex w-full font-semibold"></h5>
                                Surel : &nbsp; <strong> Lorem</strong>
                                <h5 className="flex w-full font-semibold">
                                    Media Sosial : &nbsp; <strong>Lorem</strong>
                                </h5>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </>
    );
}
