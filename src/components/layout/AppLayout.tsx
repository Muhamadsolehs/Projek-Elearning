import React from 'react';
import { Outlet } from 'react-router-dom';
import { Sidebar } from './Sidebar';
import { Topbar } from './Topbar';

export const AppLayout: React.FC = () => {
  return (
    <div className="min-h-screen bg-[#EAF2FF] p-2.5 sm:p-3.5 lg:p-4.5 flex flex-col justify-center items-center">
      {/* Main Big Application Rounded Container */}
      <div className="w-full max-w-[1536px] bg-white rounded-[24px] shadow-[0_12px_44px_rgba(23,72,150,0.08)] border border-[#E6ECF5]/80 overflow-hidden flex flex-col md:flex-row min-h-[96vh]">
        {/* Left Sidebar */}
        <Sidebar />

        {/* Right Main Application Area */}
        <div className="flex-1 flex flex-col min-w-0 bg-[#FBFDFF]">
          {/* Header */}
          <Topbar />

          {/* Dynamic Page Content */}
          <main className="flex-1 p-4 lg:p-5 overflow-y-auto">
            <Outlet />
          </main>
        </div>
      </div>
    </div>
  );
};

