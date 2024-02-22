import { cn } from "@/lib/utils";
import { Link } from "@inertiajs/react";
import React from "react";

export default function Navbar({ className }) {
    return (
        <nav className={cn("h-[460px] max-h-[460px] relative", className)}>
            <div className="w-full block z-10">
                <div className="sm:hidden md:flex items-center justify-between mx-auto p-4 md:px-20">
                    <Link
                        className="flex items-center space-x-4 text-white"
                        href="/"
                    >
                        <img src="/image/logo.png" alt="" className="size-16" />
                        <h4 className="text-xl">
                            PERPUSTAKAAN <strong>SMK NEGERI JATIPURO</strong>
                        </h4>
                    </Link>
                    <ul className="font-medium flex flex-row space-x-8 rtl:space-x-reverse mt-0 border-0">
                        <li>
                            <Link
                                href="/"
                                className={cn(
                                    "block py-2 px-3 border-0 p-0",
                                    window.location.pathname === "/"
                                        ? "text-white"
                                        : "text-[#ffffffbf] hover:text-white"
                                )}
                            >
                                Beranda
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/informasi"
                                className={cn(
                                    "block py-2 px-3 border-0 p-0",
                                    window.location.pathname == "/informasi"
                                        ? "text-white"
                                        : "text-[#ffffffbf] hover:text-white"
                                )}
                            >
                                Informasi
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/pustakawan"
                                className={cn(
                                    "block py-2 px-3 border-0 p-0",
                                    window.location.pathname == "/pustakawan"
                                        ? "text-white"
                                        : "text-[#ffffffbf] hover:text-white"
                                )}
                            >
                                Pustakawan
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <img
                className={cn(
                    "h-full w-screen bg-contain absolute top-0 z-[-1] brightness-50",
                    className
                )}
                src="/image/perpus.jpg"
                alt="bg-cover"
            />
        </nav>
    );
}
